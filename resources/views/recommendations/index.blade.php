<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-teal-500">Recomendaciones</span>
                <span class="text-gray-800"> para ti</span>
            </h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Descubre lugares extraordinarios y experiencias únicas adaptadas a tus preferencias de viaje</p>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex p-1 bg-gray-100 rounded-full">
                    <button class="px-4 py-2 text-sm font-medium rounded-full bg-green-600 text-white">Todo</button>
                    <button class="px-4 py-2 text-sm font-medium rounded-full text-gray-700 hover:bg-gray-200 transition-colors">Atracciones</button>
                    <button class="px-4 py-2 text-sm font-medium rounded-full text-gray-700 hover:bg-gray-200 transition-colors">Destinos</button>
                </div>
            </div>
        </div>

        <!-- Sección Atracciones -->
        <div class="mb-16">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-100 text-green-600 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-800">Atracciones destacadas</h2>
                </div>
                <a href="#" class="text-green-600 hover:text-green-700 font-medium flex items-center text-sm">
                    Ver todas
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            @if($attractions->isEmpty())
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">No hay atracciones recomendadas</h3>
                    <p class="text-gray-500">Explora otras categorías o vuelve más tarde para ver nuevas recomendaciones</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($attractions as $attraction)
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group">
                            <!-- Imagen con overlay de gradiente -->
                            <div class="h-48 bg-gradient-to-r from-green-400 to-teal-500 relative overflow-hidden">
                                <!-- Aquí podrías poner una imagen real -->
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity"></div>

                                <!-- Badge de tipo -->
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-green-700">
                                        {{ $attraction->type }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition-colors">{{ $attraction->name }}</h3>

                                <!-- Estrellas de calificación - estático para ejemplo -->
                                <div class="flex items-center mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i < 4 ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="text-xs text-gray-500 ml-1">(4.0)</span>
                                </div>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $attraction->description }}</p>

                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <a href="{{ route('tourist.attraction.show', $attraction->id) }}" class="group-hover:text-green-600 font-medium text-sm flex items-center">
                                        Ver detalles
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>

                                    <!-- Botón de favorito -->
                                    <button class="p-2 rounded-full hover:bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sección Destinos -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-100 text-blue-600 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </span>
                    <h2 class="text-2xl font-bold text-gray-800">Destinos populares</h2>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium flex items-center text-sm">
                    Ver todos
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            @if($destinations->isEmpty())
                <div class="bg-white rounded-xl shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">No hay destinos recomendados</h3>
                    <p class="text-gray-500">Explora otras categorías o vuelve más tarde para ver nuevas recomendaciones</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($destinations as $destination)
                        <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group">
                            <!-- Imagen con overlay de gradiente - para destino usamos color diferente -->
                            <div class="h-48 bg-gradient-to-r from-blue-400 to-indigo-500 relative overflow-hidden">
                                <!-- Aquí podrías poner una imagen real -->
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity"></div>

                                <!-- Badge de tipo -->
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-blue-700">
                                        {{ $destination->type }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">{{ $destination->name }}</h3>

                                <!-- Localización -->
                                <div class="flex items-center mb-3 text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $destination->state }}</span>
                                </div>

                                <!-- Tags ficticios para ilustrar el diseño -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        Tendencia
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        Popular
                                    </span>
                                </div>

                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <a href="#" class="group-hover:text-blue-600 font-medium text-sm flex items-center">
                                        Ver detalles
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>

                                    <!-- Indicador de distancia ficticio -->
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        2.5 hrs
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Newsletter suscription -->
        <div class="mt-16 bg-gradient-to-r from-green-600 to-teal-500 rounded-2xl p-8 lg:p-12 text-white">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="mb-6 lg:mb-0 lg:mr-8">
                    <h3 class="text-2xl font-bold mb-2">¿Quieres más recomendaciones?</h3>
                    <p class="text-green-100">Suscríbete para recibir nuestras mejores sugerencias personalizadas directamente en tu correo.</p>
                </div>

                <div class="w-full lg:w-auto">
                    <div class="flex">
                        <input
                            type="email"
                            placeholder="Tu correo electrónico"
                            class="flex-1 rounded-l-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-500"
                        >
                        <button class="bg-green-800 hover:bg-green-900 text-white font-medium px-6 py-3 rounded-r-lg transition-colors">
                            Suscribirse
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
