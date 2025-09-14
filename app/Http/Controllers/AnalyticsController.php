<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(RecommendationService $recommendation)
    {
        $users = DB::table('users')->limit(100)->pluck('id');

        $viewCounts = [];
        $avgRatings = [];
        $searchCounts = [];
        $historyCounts = [];
        $predictedClasses = [];

        foreach ($users as $userId) {
            $views = DB::table('view_logs')->where('user_id', $userId)->count();
            $searches = DB::table('search_logs')->where('user_id', $userId)->count();
            $history = DB::table('user_histories')->where('user_id', $userId)->count();
            $rating = (float) DB::table('reviews')->where('user_id', $userId)->avg('rating') ?? 3.5;

            $features = [$views, $rating, $searches, $history];
            $prediction = $recommendation->predictForUser($features);

            $viewCounts[] = $views;
            $avgRatings[] = $rating;
            $searchCounts[] = $searches;
            $historyCounts[] = $history;
            $predictedClasses[] = $prediction[0] ?? null;
        }

        $data = [
            'view_counts' => $viewCounts,
            'avg_ratings' => $avgRatings,
            'search_counts' => $searchCounts,
            'history_counts' => $historyCounts,
            'predicted_classes' => $predictedClasses,
        ];

        return view('analytics.index', compact('data'));
    }
}
