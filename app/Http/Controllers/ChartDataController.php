<?php

namespace App\Http\Controllers;

use App\Models\{Attraction, Destination, ViewLog, SearchLog, Comment, Review, UserHistory, User};
use Illuminate\Support\Facades\{Auth, DB, Cache, Log};
use Illuminate\Http\JsonResponse; // Para devolver respuestas JSON
use Illuminate\Support\Collection; // Aunque no se usa directamente en este método, podría ser útil

class ChartDataController extends Controller
{
    const CACHE_TIME = 3600; // Puedes reutilizar la constante si quieres caché aquí también

    /**
     * Retorna los datos necesarios para los gráficos de recomendaciones en formato JSON.
     * @return JsonResponse
     */
    public function getRecommendationChartData(): JsonResponse
    {
        $userId = Auth::id();
        $cacheKey = "chart_recommendations_data_{$userId}";

        // Opcional: Reutilizar la lógica de obtención de recomendaciones si es costosa.
        // Aquí asumimos que las recomendaciones ya están calculadas y podríamos obtenerlas,
        // o si queremos una total independencia, podríamos recalcular un subset.
        // Para simplificar, asumiremos que llamamos a una lógica similar a la de RecommenderController
        // o que directamente obtenemos las recomendaciones de la caché si fueron guardadas por RecommenderController.

        // Para este ejemplo, haremos una llamada directa a los datos de comportamiento y luego a las "recomendaciones"
        // que serían la base para los gráficos. Lo ideal es que el RecommenderController
        // guarde las recomendaciones finales (con categorías) en caché y este controlador solo las lea.
        // Pero para un ejemplo funcional directo, podemos replicar la obtención.

        // *************** IMPORTANTE ***************
        // Si las recomendaciones son muy costosas de generar, el RecommenderController
        // debería guardar en caché las _recomendaciones finales_ con sus categorías.
        // Este ChartDataController solo las leería de la caché.
        // Para este ejemplo, simplificamos y las obtenemos de nuevo para ilustrar el proceso.
        // ******************************************

        $data = Cache::remember($cacheKey, self::CACHE_TIME, function () use ($userId) {
            // Aquí puedes llamar a los mismos métodos que RecommenderController si las categorías
            // ya están cargadas en los modelos, o si quieres una preparación de datos más ligera.
            // Para ser totalmente independiente, deberías volver a obtener las atracciones/destinos
            // que serían relevantes para los gráficos.

            // Una forma más limpia sería que RecommenderController guardara un JSON
            // con las atracciones y destinos recomendados (incluyendo la categoría) en caché.
            // Aquí lo obtendríamos de esa caché.
            // Por simplicidad, voy a simular que se tienen las colecciones de atracciones/destinos
            // que RecommenderController ya calculó.

            // Simulación: En un escenario real, $recommendedAttractions y $recommendedDestinations
            // vendrían de una fuente de datos (cache, DB, o un método compartido).
            // Para que este controlador sea *totalmente independiente* y solo devuelva datos para gráficos,
            // no debería depender de los métodos protected de RecommenderController directamente.
            // Aquí, para el ejemplo, vamos a buscar atracciones/destinos con categoría directamente,
            // asumiendo que ya hay recomendaciones válidas para graficar.

            // Esto es una simplificación. En un sistema más robusto,
            // $recommendedAttractions y $recommendedDestinations deberían ser el RESULTADO
            // de las predicciones del RecommenderController, quizás guardadas en otra caché
            // o en un formato fácilmente consultable.
            $recommendedAttractions = Attraction::inRandomOrder()->limit(10)->get(); // Ejemplo: obtén algunas para simular
            $recommendedDestinations = Destination::inRandomOrder()->limit(10)->get(); // Ejemplo: obtén algunas para simular

            // Idealmente, obtendrías esto de donde RecommenderController almacena sus resultados finales.
            // Por ejemplo, si RecommenderController almacena las IDs en la caché, las obtendrías así:
            /*
            $recoIds = Cache::get("user_recommendations_ids_{$userId}"); // IDs guardadas por RecommenderController
            if ($recoIds) {
                $recommendedAttractions = Attraction::whereIn('id', $recoIds['attractions'])->get();
                $recommendedDestinations = Destination::whereIn('id', $recoIds['destinations'])->get();
            } else {
                // Fallback si no hay IDs en caché, o llamar al RecommenderController para generarlas.
                // Esto podría hacer que este controlador sea menos "puro" en su responsabilidad.
            }
            */

            $attractionCategories = $recommendedAttractions->pluck('category')->filter()->countBy()->toArray();
            $destinationCategories = $recommendedDestinations->pluck('category')->filter()->countBy()->toArray();

            return [
                'attractionCategoriesLabels' => array_keys($attractionCategories),
                'attractionCategoriesData' => array_values($attractionCategories),
                'destinationCategoriesLabels' => array_keys($destinationCategories),
                'destinationCategoriesData' => array_values($destinationCategories),
            ];
        });

        return response()->json($data);
    }
}
