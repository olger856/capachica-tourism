<?php

namespace App\Http\Controllers;

use App\Models\{Attraction, Destination, ViewLog, SearchLog, Comment, Review, UserHistory, User};
use Illuminate\Support\Facades\{Auth, DB, Cache, Log};
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Illuminate\Support\Collection;

class RecommenderController extends Controller
{
    const CACHE_TIME = 3600;

    public function index()
    {
        $userId = Auth::id();
        $cacheKey = "user_recommendations_{$userId}";

        $userData = $this->getUserBehaviorData($userId);

        // Verifica si el usuario no ha hecho ninguna interacción
        $isNewUser = empty($userData['viewed_attractions']) &&
                    empty($userData['visited_destinations']) &&
                    empty($userData['searched_keywords']) &&
                    empty($userData['rated_attractions']) &&
                    empty($userData['rated_destinations']);

        if ($isNewUser) {
            return view('recommendations.index', [
                'attractions' => collect(),
                'destinations' => collect(),
                'message' => 'Aún no hay suficientes datos para mostrarte recomendaciones personalizadas. Explora el sitio para comenzar a recibir sugerencias.'
            ]);
        }

        $data = Cache::remember($cacheKey, self::CACHE_TIME, function () use ($userData) {
            return [
                'attractions' => $this->getAttractionRecommendations($userData),
                'destinations' => $this->getDestinationRecommendations($userData),
            ];
        });

        return view('recommendations.index', $data);
    }


    protected function getUserBehaviorData(int $userId): array
    {
        try {
            return [
                'viewed_attractions' => ViewLog::where('user_id', $userId)->pluck('attraction_id')->toArray(),
                'visited_destinations' => UserHistory::where('user_id', $userId)->pluck('destination_id')->toArray(),
                'searched_keywords' => SearchLog::where('user_id', $userId)->pluck('keyword')->filter()->toArray(),
                'rated_attractions' => Comment::where('user_id', $userId)->where('rating', '>=', 4)->pluck('attraction_id')->toArray(),
                'rated_destinations' => Review::where('user_id', $userId)->where('rating', '>=', 4)->pluck('destination_id')->toArray(),
                'average_rating' => $this->calculateUserAverageRating($userId),
            ];
        } catch (\Exception $e) {
            Log::error("Error in getUserBehaviorData: " . $e->getMessage());
            return [
                'viewed_attractions' => [],
                'visited_destinations' => [],
                'searched_keywords' => [],
                'rated_attractions' => [],
                'rated_destinations' => [],
                'average_rating' => 3.5,
            ];
        }
    }

    protected function calculateUserAverageRating(int $userId): float
    {
        try {
            $attractionRatings = (float) Comment::where('user_id', $userId)->avg('rating');
            $destinationRatings = (float) Review::where('user_id', $userId)->avg('rating');

            if ($attractionRatings > 0 && $destinationRatings > 0) {
                return ($attractionRatings + $destinationRatings) / 2;
            } elseif ($attractionRatings > 0) {
                return $attractionRatings;
            } elseif ($destinationRatings > 0) {
                return $destinationRatings;
            }

            return 3.5;
        } catch (\Exception $e) {
            Log::error("Error calculating average rating: " . $e->getMessage());
            return 3.5;
        }
    }

    // --- ATRACCIONES ---

    protected function getAttractionRecommendations(array $userData): Collection
    {
        try {
            $hasViewedOrRated = !empty($userData['viewed_attractions']) || !empty($userData['rated_attractions']);

            if (!$hasViewedOrRated) {
                return $this->getFallbackAttractions($userData);
            }

            $dataset = $this->prepareAttractionDataset();
            $userFeatures = $this->extractAttractionFeatures($userData);

            $estimator = new KNearestNeighbors(5);
            $estimator->train($dataset);

            $predictions = $estimator->predict(new Unlabeled([$userFeatures]));

            $predictedIds = is_array($predictions[0]) ? $predictions[0] : [$predictions[0]];
            $predictedIds = array_filter($predictedIds, fn($id) => !empty($id) && is_numeric($id));

            return $this->fetchRecommendedAttractions(
                array_merge($predictedIds, $userData['viewed_attractions'], $userData['rated_attractions'])
            );
        } catch (\Exception $e) {
            Log::error("Attraction prediction failed: " . $e->getMessage());
            return $this->getFallbackAttractions($userData);
        }
    }

    protected function prepareAttractionDataset(): Labeled
    {
        $samples = [];
        $labels = [];

        try {
            $userComments = DB::table('comments')
                ->select('user_id', 'attraction_id', 'rating')
                ->whereNotNull('user_id')
                ->whereNotNull('attraction_id')
                ->get();

            $userInteractions = $userComments->groupBy('user_id');

            foreach ($userInteractions as $userId => $interactions) {
                if (empty($userId)) continue;

                $viewCount = ViewLog::where('user_id', $userId)->count();
                $searchCount = SearchLog::where('user_id', $userId)->count();
                $historyCount = UserHistory::where('user_id', $userId)->count();

                $avgRating = 0;
                $totalRatings = 0;

                foreach ($interactions as $interaction) {
                    if (is_numeric($interaction->rating)) {
                        $avgRating += $interaction->rating;
                        $totalRatings++;
                    }
                }

                $avgRating = $totalRatings > 0 ? $avgRating / $totalRatings : 0;

                $samples[] = [
                    $viewCount,
                    (float) $avgRating,
                    $searchCount,
                    $historyCount,
                ];

                $attractionIds = collect($interactions)->pluck('attraction_id')->unique()->toArray();

                if (!empty($attractionIds)) {
                    $labels[] = $attractionIds;
                } else {
                    array_pop($samples);
                }
            }

            if (empty($samples) || empty($labels)) {
                return new Labeled([[0, 0, 0, 0]], [[1]]);
            }

            return new Labeled($samples, $labels);
        } catch (\Exception $e) {
            Log::error("Error in prepareAttractionDataset: " . $e->getMessage());
            return new Labeled([[0, 0, 0, 0]], [[1]]);
        }
    }

    protected function extractAttractionFeatures(array $userData): array
    {
        return [
            count($userData['viewed_attractions']),
            (float) ($userData['average_rating'] ?? 3.5),
            count($userData['searched_keywords']),
            count($userData['visited_destinations']),
        ];
    }

    protected function fetchRecommendedAttractions(array $attractionIds): Collection
    {
        try {
            $uniqueIds = array_filter(array_unique($attractionIds), fn($id) => !empty($id) && is_numeric($id));

            if (empty($uniqueIds)) return collect();

            return DB::table('attractions')
                ->whereIn('id', $uniqueIds)
                ->select('*')
                ->get();
        } catch (\Exception $e) {
            Log::error("Error fetching recommended attractions: " . $e->getMessage());
            return collect();
        }
    }

    protected function getFallbackAttractions(array $userData): Collection
    {
        return Attraction::inRandomOrder()->limit(10)->get();
    }

    // --- DESTINOS ---

    protected function getDestinationRecommendations(array $userData): Collection
    {
        try {
            $hasVisitedOrRated = !empty($userData['visited_destinations']) || !empty($userData['rated_destinations']);

            if (!$hasVisitedOrRated) {
                return $this->getFallbackDestinations();
            }

            $dataset = $this->prepareDestinationDataset();
            $userFeatures = $this->extractDestinationFeatures($userData);

            $estimator = new KNearestNeighbors(5);
            $estimator->train($dataset);

            $predictions = $estimator->predict(new Unlabeled([$userFeatures]));

            $predictedIds = is_array($predictions[0]) ? $predictions[0] : [$predictions[0]];
            $predictedIds = array_filter($predictedIds, fn($id) => !empty($id) && is_numeric($id));

            return $this->fetchRecommendedDestinations(
                array_merge($predictedIds, $userData['visited_destinations'], $userData['rated_destinations'])
            );
        } catch (\Exception $e) {
            Log::error("Destination prediction failed: " . $e->getMessage());
            return $this->getFallbackDestinations();
        }
    }

    protected function prepareDestinationDataset(): Labeled
    {
        $samples = [];
        $labels = [];

        try {
            $userReviews = DB::table('reviews')
                ->select('user_id', 'destination_id', 'rating')
                ->whereNotNull('user_id')
                ->whereNotNull('destination_id')
                ->get();

            $userInteractions = $userReviews->groupBy('user_id');

            foreach ($userInteractions as $userId => $interactions) {
                if (empty($userId)) continue;

                $viewCount = ViewLog::where('user_id', $userId)->count();
                $searchCount = SearchLog::where('user_id', $userId)->count();
                $historyCount = UserHistory::where('user_id', $userId)->count();

                $avgRating = 0;
                $totalRatings = 0;

                foreach ($interactions as $interaction) {
                    if (is_numeric($interaction->rating)) {
                        $avgRating += $interaction->rating;
                        $totalRatings++;
                    }
                }

                $avgRating = $totalRatings > 0 ? $avgRating / $totalRatings : 0;

                $samples[] = [
                    $viewCount,
                    (float) $avgRating,
                    $searchCount,
                    $historyCount,
                ];

                $destinationIds = collect($interactions)->pluck('destination_id')->unique()->toArray();

                if (!empty($destinationIds)) {
                    $labels[] = $destinationIds;
                } else {
                    array_pop($samples);
                }
            }

            if (empty($samples) || empty($labels)) {
                return new Labeled([[0, 0, 0, 0]], [[1]]);
            }

            return new Labeled($samples, $labels);
        } catch (\Exception $e) {
            Log::error("Error in prepareDestinationDataset: " . $e->getMessage());
            return new Labeled([[0, 0, 0, 0]], [[1]]);
        }
    }

    protected function extractDestinationFeatures(array $userData): array
    {
        return [
            count($userData['viewed_attractions']),
            (float) ($userData['average_rating'] ?? 3.5),
            count($userData['searched_keywords']),
            count($userData['visited_destinations']),
        ];
    }

    protected function fetchRecommendedDestinations(array $destinationIds): Collection
    {
        try {
            $uniqueIds = array_filter(array_unique($destinationIds), fn($id) => !empty($id) && is_numeric($id));

            if (empty($uniqueIds)) return collect();

            return DB::table('destinations')
                ->whereIn('id', $uniqueIds)
                ->select('*')
                ->get();
        } catch (\Exception $e) {
            Log::error("Error fetching recommended destinations: " . $e->getMessage());
            return collect();
        }
    }

    protected function getFallbackDestinations(): Collection
    {
        return Destination::inRandomOrder()->limit(10)->get();
    }
}
