<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Navegación de migas de pan -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('attractions.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-indigo-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $attraction->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Información principal de la atracción -->
            <div class="flex-1 order-2 lg:order-1">
                <div class="bg-white rounded-2xl shadow-md p-8 mb-6">
                    <!-- Encabezado con nombre y estadísticas -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $attraction->name }}</h1>
                        <div class="flex items-center space-x-4 text-sm">
                            <div class="flex items-center text-yellow-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="ml-1 font-medium">
                                    {{ number_format($attraction->comments->avg('rating') ?? 0, 1) }}
                                    <span class="text-gray-500 font-normal">({{ $attraction->comments->count() }} reseñas)</span>
                                </span>
                            </div>
                            <span class="text-gray-400">|</span>
                            <span class="text-gray-600">{{ $attraction->type ?? 'Atracción Turística' }}</span>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-3">Sobre este lugar</h2>
                        <div class="text-gray-700 leading-relaxed space-y-4">
                            <p>{{ $attraction->description }}</p>
                        </div>
                    </div>

                    <!-- 🗺️ Ubicación -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Ubicación
                        </h2>
                        <div class="mt-2 text-sm text-gray-600">
                            <span class="font-medium">Coordenadas:</span> {{ $attraction->latitude }}, {{ $attraction->longitude }}
                        </div>

                        <div id="attractionMap" class="mt-4 bg-gray-100 rounded-lg border border-gray-200" style="height: 400px; width: 100%;"></div>
                    </div>
                </div>
            </div>

            <!-- Comentarios y Reseñas -->
            <div class="lg:w-1/3 order-1 lg:order-2">
                <div class="bg-white rounded-2xl shadow-md p-6 sticky top-6">
                    <h2 class="text-xl font-semibold mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        Comentarios y Reseñas
                    </h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-md flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">Por favor corrige los siguientes errores:</span>
                            </div>
                            <ul class="list-disc list-inside text-sm pl-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tourist.attraction.comment', $attraction->id) }}" class="mb-8">
                        @csrf
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Tu comentario</label>
                            <textarea id="comment" name="comment" required class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow" placeholder="Comparte tu experiencia aquí..." rows="4"></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tu calificación</label>
                            <div class="flex items-center rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden" {{ $i == 5 ? 'checked' : '' }}>
                                    <label for="star{{ $i }}" class="cursor-pointer text-2xl px-1 text-gray-300 hover:text-yellow-400">★</label>
                                @endfor
                                <span class="ml-2 text-sm text-gray-500" id="ratingText">Excelente</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-sm transition duration-200 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Enviar comentario
                        </button>
                    </form>

                    <div class="mt-8">
                        <h3 class="text-lg font-medium mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                            </svg>
                            Reseñas de otros visitantes
                        </h3>

                        <div class="space-y-6 max-h-96 overflow-y-auto pr-2 custom-scrollbar">
                            @forelse ($attraction->comments as $comment)
                                <div class="bg-gray-50 rounded-lg p-4 transition-transform hover:translate-x-1 duration-200">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-medium text-sm">
                                                    {{ strtoupper(substr($comment->user?->name ?? 'U', 0, 1)) }}
                                                </div>
                                                <div class="ml-3">
                                                    <p class="font-medium text-gray-800">{{ $comment->user?->name ?? 'Usuario eliminado' }}</p>
                                                    <p class="text-xs text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex text-yellow-400">
                                            @for ($i = 0; $i < 5; $i++)
                                                <span>{{ $i < $comment->rating ? '★' : '☆' }}</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mt-3 text-gray-700 text-sm">
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 bg-gray-50 rounded-lg">
                                    <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <p class="mt-3 text-gray-500 font-medium">No hay comentarios aún.</p>
                                    <p class="text-sm text-gray-400 mt-1">¡Sé el primero en dejar tu opinión!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ⭐ Interactividad estrellas -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ratingLabels = document.querySelectorAll('.rating label');
            const ratingText = document.getElementById('ratingText');
            const ratingTexts = ['Malo', 'Regular', 'Bueno', 'Muy bueno', 'Excelente'];

            ratingLabels.forEach((label, index) => {
                label.addEventListener('click', () => {
                    const rating = 5 - index;
                    ratingText.textContent = ratingTexts[rating - 1];

                    ratingLabels.forEach((l, i) => {
                        l.classList.toggle('text-yellow-400', i >= index);
                        l.classList.toggle('text-gray-300', i < index);
                    });
                });
            });
        });
    </script>

    <!-- 🗺️ Leaflet.js Mapa gratuito -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const lat = parseFloat("{{ $attraction->latitude }}");
            const lng = parseFloat("{{ $attraction->longitude }}");

            if (isNaN(lat) || isNaN(lng)) {
                document.getElementById("attractionMap").innerHTML =
                    "<p class='text-center p-6 text-gray-600'>Error: Coordenadas no válidas.</p>";
                return;
            }

            const map = L.map("attractionMap").setView([lat, lng], 14);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(map);

            L.marker([lat, lng]).addTo(map)
                .bindPopup("<b>{{ $attraction->name }}</b>")
                .openPopup();
        });
    </script>

    <style>
        /* Scrollbar personalizada */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    </style>
</x-app-layout>
