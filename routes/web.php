<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\CsvUploadController;
use App\Http\Controllers\RecommenderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard accesible para cualquier usuario autenticado
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/recommendations', [RecommenderController::class, 'index'])->name('recommendations.index');

    // Ruta para mostrar los gráficos de recomendaciones (vista)
    Route::get('/recommendations/charts', function () {
        return view('charts');
    })->name('recommendations.charts');

    // Ruta para devolver los datos de las gráficas en JSON
    Route::get('/chart-data/recommendations', [ChartDataController::class, 'getRecommendationChartData'])
        ->name('chart_data.recommendations');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ruta para turistas, admins y superadmins (validación en controlador)
    Route::get('/tourist/attractions', [TouristController::class, 'index'])->name('tourist.attractions');

    // Ruta para búsqueda de atracciones (con filtros)
    Route::get('/search', [AttractionController::class, 'search'])->name('attractions.search');

    // Ruta para mostrar recomendaciones personalizadas
    Route::get('/attractions/recommendations', [AttractionController::class, 'showRecommendations'])
        ->name('attractions.recommendations');

    // Detalle de atracción y comentarios
    Route::get('/tourist/attractions/{id}', [TouristController::class, 'show'])->name('tourist.attraction.show');
    Route::post('/tourist/attractions/{id}/comment', [TouristController::class, 'storeComment'])->name('tourist.attraction.comment');

    // Rutas exclusivas para admin y superadmin
    Route::middleware('auth')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            $user = Auth::user();
            if (!$user->role || !in_array($user->role->name, ['admin', 'superadmin'])) {
                abort(403, 'No tienes permiso.');
            }
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/stats', [AdminController::class, 'adminStats'])->name('admin.stats');
        Route::get('/admin/stats', [AdminController::class, 'stats'])->name('admin.stats');
        Route::get('/csv-upload', [CsvUploadController::class, 'index'])->name('admin.csv.upload.form');
        Route::post('/csv-upload', [CsvUploadController::class, 'uploadCsv'])->name('admin.csv.upload');
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
        Route::get('/recommendations/charts', function () {
            return view('charts');
        })->name('admin.recommendations.charts');

        // Ruta para el informe de Power BI (solo admin)
        Route::get('/powerbi', function () {
            $user = Auth::user();
            if (!$user->role || !in_array($user->role->name, ['admin', 'superadmin'])) {
                abort(403, 'No tienes permiso.');
            }
            return view('admin.powerbi');
        })->name('admin.powerbi');

    });

    // Ruta exclusiva para superadmin
    Route::get('/superadmin/panel', function () {
        $user = Auth::user();
        if (!$user->role || $user->role->name !== 'superadmin') {
            abort(403, 'No tienes permiso.');
        }
        return view('superadmin.panel');
    })->name('superadmin.panel');

    // Ruta para listar atracciones (general)
    Route::get('/attractions', [AttractionController::class, 'index'])->name('attractions.index');
});

require __DIR__.'/auth.php';
