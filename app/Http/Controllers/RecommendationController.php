<?php

namespace App\Http\Controllers;

use App\Models\{Attraction, Destination, ViewLog, SearchLog, Comment, Review, UserHistory};
use Illuminate\Support\Facades\{Auth, DB, Cache};
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Rubix\ML\CrossValidation\Metrics\FBeta;
use Rubix\ML\Transformers\NumericStringConverter;

class RecommenderController extends Controller
{
    const CACHE_TIME = 3600; // 1 hora en segundos

    public function index()
    {
        $userId = Auth::id();
        $cacheKey = "user_recommendations_{$userId}";

        // Usar caché para evitar recalcular recomendaciones frecuentemente
        return Cache::remember($cacheKey, self::CACHE_TIME, function() use ($userId) {
            return $this->generateRecommendations($userId);
        });
    }

    protected function generateRecommendations($userId)
    {
        // 1. Datos del usuario
        $userData = $this->getUserBehaviorData($userId);

        // 2. Modelo predictivo para atracciones
        $attractionRecommendations = $this->predictAttractions($userData);

        // 3. Modelo predictivo para destinos
        $destinationRecommendations = $this->predictDestinations($userData);

        return view('recommendations.index', [
            'attractions' => $attractionRecommendations,
            'destinations' => $destinationRecommendations,
        ]);
    }

    protected function getUserBehaviorData($userId)
    {
        return [
            'viewed_attractions' => ViewLog::where('user_id', $userId)->pluck('attraction_id')->toArray(),
            'visited_destinations' => UserHistory::where('user_id', $userId)->pluck('destination_id')->toArray(),
            'searched_keywords' => SearchLog::where('user_id', $userId)->pluck('keyword')->filter()->toArray(),
            'rated_attractions' => Comment::where('user_id', $userId)->where('rating', '>=', 4)->pluck('attraction_id')->toArray(),
            'rated_destinations' => Review::where('user_id', $userId)->where('rating', '>=', 4)->pluck('destination_id')->toArray(),
            'average_rating' => Review::where('user_id', $userId)->avg('rating') ?? 3.5,
        ];
    }

    protected function predictAttractions(array $userData)
    {
        // 1. Obtener dataset de entrenamiento
        $dataset = $this->prepareAttractionDataset();

        // 2. Entrenar modelo KNN (ejemplo básico)
        $estimator = new KNearestNeighbors(5);
        $estimator->train($dataset);

        // 3. Preparar datos del usuario para predicción
        $userFeatures = $this->extractAttractionFeatures($userData);
        $unlabeled = new Unlabeled([$userFeatures]);

        // 4. Predecir atracciones recomendadas
        $predictions = $estimator->predict($unlabeled);

        // 5. Obtener las mejores atracciones
        return Attraction::whereIn('id', $predictions[0])
            ->with(['destination', 'reviews'])
            ->orderBy('average_rating', 'desc')
            ->limit(10)
            ->get();
    }

    protected function prepareAttractionDataset()
    {
        // Datos de ejemplo - en producción esto vendría de tu base de datos
        $samples = [];
        $labels = [];

        // Obtener datos históricos de todos los usuarios
        $userHistories = DB::table('user_histories')
            ->select('user_id', 'attraction_id', 'rating')
            ->get()
            ->groupBy('user_id');

        foreach ($userHistories as $userId => $interactions) {
            $features = [
                'view_count' => count($interactions),
                'avg_rating' => $interactions->avg('rating'),
                // Aquí puedes añadir más características
            ];

            $attractionIds = $interactions->pluck('attraction_id')->toArray();
            $samples[] = $features;
            $labels[] = $attractionIds;
        }

        return new Labeled($samples, $labels);
    }

    protected function extractAttractionFeatures(array $userData)
    {
        return [
            'view_count' => count($userData['viewed_attractions']),
            'rated_count' => count($userData['rated_attractions']),
            'avg_rating' => $userData['average_rating'],
            'search_terms' => count($userData['searched_keywords']),
            // Puedes añadir más características relevantes
        ];
    }

    protected function predictDestinations(array $userData)
    {
        // Implementación similar a predictAttractions pero para destinos
        // Puedes usar un modelo diferente optimizado para destinos

        // Ejemplo simplificado:
        $ratedDestinations = $userData['rated_destinations'];
        $visitedDestinations = $userData['visited_destinations'];

        // Combinar destinos visitados y calificados
        $allDestinations = array_unique(array_merge($ratedDestinations, $visitedDestinations));

        // Si no hay suficientes datos, usar destinos populares como respaldo
        if (count($allDestinations) < 3) {
            $allDestinations = array_merge(
                $allDestinations,
                Destination::popular()->pluck('id')->toArray()
            );
        }

        return Destination::whereIn('id', $allDestinations)
            ->with(['attractions', 'reviews'])
            ->orderBy('average_rating', 'desc')
            ->limit(10)
            ->get();
    }
}
