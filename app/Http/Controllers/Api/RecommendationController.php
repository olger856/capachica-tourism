<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function getRecommendations($user_id)
    {
        $recommendations = Recommendation::with('destination')
            ->where('user_id', $user_id)
            ->get();

        return response()->json($recommendations, 200);
    }
}
