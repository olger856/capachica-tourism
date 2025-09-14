<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminStats()
    {
        $data = Attraction::withCount('viewLogs')
            ->withAvg('comments', 'rating')
            ->orderByDesc('view_logs_count')
            ->limit(5)
            ->get();

        $labels = $data->pluck('name');
        $views = $data->pluck('view_logs_count');
        $ratings = $data->pluck('comments_avg_rating')->map(function ($rating) {
            return round($rating, 2);
        });

        return view('admin.stats', compact('labels', 'views', 'ratings'));
    }




}
