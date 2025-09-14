<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\ViewLog; // Modelo para registrar vistas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TouristController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->role || !in_array($user->role->name, ['turista', 'admin', 'superadmin'])) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        $attractions = Attraction::paginate(6);
        return view('tourist.attractions', compact('attractions'));
    }

    public function show($id)
    {
        $attraction = Attraction::with('comments.user')->findOrFail($id);

        // Registrar vista para recomendaciones, solo si hay usuario autenticado
        if (Auth::check()) {
            ViewLog::create([
                'user_id' => Auth::id(),
                'attraction_id' => $attraction->id,
            ]);
        }

        return view('tourist.attraction_detail', compact('attraction'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $attraction = Attraction::findOrFail($id);

        $attraction->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('tourist.attraction.show', $id)->with('success', 'Comentario agregado.');
    }
}
