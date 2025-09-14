<?php

namespace App\Services;

use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Classifiers\KNearestNeighbors;
use Illuminate\Support\Facades\DB;

class RecommendationService
{
    /**
     * Entrena y devuelve el modelo KNN para destinos.
     */
    public function getDestinationModel(): KNearestNeighbors
    {
        $dataset = $this->prepareDataset();
        $model = new KNearestNeighbors(5);
        $model->train($dataset);
        return $model;
    }

    /**
     * Realiza una predicción para un usuario dado su vector de características.
     */
    public function predictForUser(array $features): array
    {
        $model = $this->getDestinationModel();
        $predictions = $model->predict(new Unlabeled([$features]));
        return is_array($predictions[0]) ? $predictions[0] : [$predictions[0]];
    }

    /**
     * Prepara el dataset de entrenamiento desde las interacciones de usuarios.
     */
    private function prepareDataset(): Labeled
    {
        $samples = [];
        $labels = [];

        $userReviews = DB::table('reviews')
            ->select('user_id', 'destination_id', 'rating')
            ->whereNotNull('user_id')
            ->whereNotNull('destination_id')
            ->get();

        $userInteractions = $userReviews->groupBy('user_id');

        foreach ($userInteractions as $userId => $interactions) {
            $viewCount = DB::table('view_logs')->where('user_id', $userId)->count();
            $searchCount = DB::table('search_logs')->where('user_id', $userId)->count();
            $historyCount = DB::table('user_histories')->where('user_id', $userId)->count();
            $avgRating = $interactions->avg('rating') ?? 3.5;

            $samples[] = [
                $viewCount,
                (float) $avgRating,
                $searchCount,
                $historyCount,
            ];

            // ✅ Etiqueta como string para que Rubix la trate como categórica
            $destinationId = (string) collect($interactions)
                ->sortByDesc('rating')
                ->pluck('destination_id')
                ->first() ?? '1';

            $labels[] = $destinationId;
        }

        // Fallback si no hay datos
        if (empty($samples) || empty($labels)) {
            return new Labeled([[0, 3.5, 0, 0]], ['1']);
        }

        return new Labeled($samples, $labels);
    }
}
