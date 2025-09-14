<?php

use App\Http\Controllers\Api\AttractionApiController;
use App\Http\Controllers\Api\AttractionCommentController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\AttractionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/attractions/{attraction}/comments', [AttractionCommentController::class, 'index']);

Route::post('/attractions/{attraction}/comment', [AttractionCommentController::class, 'store']);
Route::get('/attractions/search', [AttractionApiController::class, 'search']);
Route::get('/attractions/search', [AttractionController::class, 'apiSearch']);
Route::get('/recommendations/{user_id}', [RecommendationController::class, 'getRecommendations']);
// Ruta protegida que devuelve el usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
