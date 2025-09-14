<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;  // <-- Importa la fachada DB aquí

class AttractionController extends Controller
{
    // Mostrar listado paginado (vista principal)
    public function index()
    {
        $attractions = Attraction::paginate(10);
        return view('attractions.index', compact('attractions'));
    }

    // Mostrar formulario para crear atracción
    public function create()
    {
        return view('attractions.create');
    }

    // Guardar nueva atracción
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $attraction = new Attraction();
        $attraction->name = $request->name;
        $attraction->type = $request->type;
        $attraction->description = $request->description;
        $attraction->latitude = $request->latitude;
        $attraction->longitude = $request->longitude;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('attractions', 'public');
            $attraction->image = $path;
        }

        $attraction->save();

        return redirect()->route('attractions.index')->with('success', 'Atracción creada correctamente.');
    }

    // Mostrar formulario para editar atracción
    public function edit(Attraction $attraction)
    {
        return view('attractions.edit', compact('attraction'));
    }

    // Actualizar atracción
    public function update(Request $request, Attraction $attraction)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $attraction->name = $request->name;
        $attraction->type = $request->type;
        $attraction->description = $request->description;
        $attraction->latitude = $request->latitude;
        $attraction->longitude = $request->longitude;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('attractions', 'public');
            $attraction->image = $path;
        }

        $attraction->save();

        return redirect()->route('attractions.index')->with('success', 'Atracción actualizada correctamente.');
    }

    // Eliminar atracción
    public function destroy(Attraction $attraction)
    {
        $attraction->delete();
        return redirect()->route('attractions.index')->with('success', 'Atracción eliminada correctamente.');
    }

    // Búsqueda con filtros (vista web)
    public function search(Request $request)
    {
        $query = Attraction::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $attractions = $query->paginate(10);

        // Guardar búsqueda para recomendaciones
        SearchLog::create([
            'user_id' => Auth::id(),
            'keyword' => $request->keyword,
            'filter_type' => $request->type,
        ]);

        return view('attractions.search', compact('attractions'));
    }

    // Búsqueda con filtros (API para búsqueda en tiempo real)
    public function apiSearch(Request $request)
    {
        $query = Attraction::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('description', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Guardar búsqueda para recomendaciones
        SearchLog::create([
            'user_id' => Auth::id(),
            'keyword' => $request->keyword,
            'filter_type' => $request->type,
        ]);

        return response()->json($query->limit(20)->get());
    }

    // Obtener recomendaciones basadas en vistas y calificaciones
    public function recommendations()
    {
        return Attraction::withCount('viewLogs as views_count')
            ->withAvg('comments as avg_rating', 'rating')
            ->orderByDesc('views_count')
            ->orderByDesc('avg_rating')
            ->limit(5)
            ->get();
    }

    // Mostrar vista con recomendaciones
    public function showRecommendations()
    {
        $recommendations = $this->recommendations();
        return view('attractions.recommendations', compact('recommendations'));
    }
}
