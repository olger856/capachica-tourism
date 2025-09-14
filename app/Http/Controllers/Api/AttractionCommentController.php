<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttractionCommentController extends Controller
{
    public function index(Attraction $attraction)
    {
        $comments = $attraction->comments()->with('user')->latest()->get();
        return response()->json($comments);
    }

    public function store(Request $request, Attraction $attraction)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $comment = $attraction->comments()->create([
            'user_id' => Auth::id(), // esto será null si no está autenticado
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return response()->json($comment, 201);
    }
}
