<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Encabezado con animación suave -->
        <div class="mb-16 text-center">
            <h1 class="text-4xl font-extrabold text-gray-800">
                <span class="inline-block transform hover:scale-105 transition-transform duration-300">🌟</span>
                <span class="text-indigo-600 bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">Recomendaciones</span> para ti
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 mx-auto mt-4 rounded-full"></div>
        </div>

        @if($recommendations->isEmpty())
            <!-- Mensaje cuando no hay recomendaciones -->
            <div class="bg-gray-50 border border-gray-100 rounded-2xl p-12 text-center shadow-sm">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-xl text-gray-500 font-medium">No hay recomendaciones disponibles aún.</p>
                <p class="text-gray-400 mt-2">Vuelve pronto para descubrir lugares increíbles.</p>
            </div>
        @else
            <!-- Grid de recomendaciones -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($recommendations as $rec)
                    <div class="group relative bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden">
                        <!-- Color de fondo decorativo superior -->
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-600"></div>

                        <div class="p-6 flex flex-col justify-between h-full">
                            <div>
                                <!-- Título con hover effect -->
                                <h2 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-indigo-600 transition-colors duration-300">{{ $rec->name }}</h2>

                                <!-- Tipo con badge estilizado -->
                                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mb-3">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    {{ $rec->type }}
                                </div>

                                <!-- Estadísticas en una barra elegante -->
                                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span class="font-medium">{{ number_format($rec->avg_rating, 1) }}</span>
                                    </div>
                                    <div class="h-4 w-px bg-gray-300 mx-2"></div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 text-indigo-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>{{ $rec->views_count }}</span>
                                    </div>
                                </div>

                                <!-- Descripción con mejor formato -->
                                <p class="text-gray-600 text-sm leading-relaxed">{{ Str::limit($rec->description, 120) }}</p>
                            </div>

                            <!-- Botón de acción mejorado -->
                            <div class="mt-6">
                                <a href="{{ route('tourist.attraction.show', $rec->id) }}"
                                   class="group w-full inline-flex items-center justify-center text-center bg-indigo-600 text-white font-medium px-4 py-3 rounded-xl hover:bg-indigo-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                    Ver detalle
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Enlace de retorno mejorado -->
        <div class="mt-16 text-center">
            <a href="{{ route('attractions.index') }}"
               class="inline-flex items-center justify-center px-5 py-3 border border-indigo-100 rounded-lg text-indigo-600 hover:text-indigo-800 bg-white hover:bg-indigo-50 font-medium text-sm transition-colors duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Volver al listado principal
            </a>
        </div>
    </div>
</x-app-layout>
