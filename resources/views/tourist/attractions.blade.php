<x-app-layout>
    <div x-data="searchAndComments()" class="container mx-auto p-4 md:p-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-indigo-800">Descubre Atracciones Turísticas</h1>
            <p class="text-gray-600 mt-2">Explora los mejores destinos y comparte tus experiencias</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar de filtros -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4 text-indigo-700 border-b pb-2">Filtros</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Buscar por nombre</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input
                                    type="text"
                                    placeholder="Buscar atracción..."
                                    x-model.debounce.500="keyword"
                                    @input="search"
                                    class="pl-10 w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de atracción</label>
                            <div class="relative">
                                <select
                                    x-model="type"
                                    @change="search"
                                    class="appearance-none w-full p-3 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pr-10"
                                >
                                    <option value="">Todos los tipos</option>
                                    <option value="Playa">Playa</option>
                                    <option value="Sitio Arqueológico">Sitio Arqueológico</option>
                                    <!-- Más tipos -->
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button
                            @click="resetFilters"
                            class="w-full mt-2 flex justify-center items-center space-x-2 py-2 px-4 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors duration-200"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span>Limpiar filtros</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Lista dinámica de atracciones -->
            <div class="lg:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="attraction in attractions" :key="attraction.id">
                        <div class="bg-white border rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                            <!-- Imagen de la atracción (placeholder) -->
                            <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 relative">
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-white text-indigo-800" x-text="attraction.type"></span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex justify-between items-start">
                                    <h2 class="text-xl font-bold text-gray-800 mb-2" x-text="attraction.name"></h2>
                                    <!-- Aquí podrías agregar estrellas de rating si lo necesitas -->
                                </div>

                                <p class="text-gray-600 mb-4 line-clamp-3" x-text="attraction.description"></p>

                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span x-text="`${attraction.latitude.toFixed(4)}, ${attraction.longitude.toFixed(4)}`"></span>
                                </div>

                                <div class="flex space-x-2">
                                    <a
                                        :href="`/tourist/attractions/${attraction.id}`"
                                        class="flex-1 flex justify-center items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Ver detalle
                                    </a>

                                    <button
                                        @click="openSidebar(attraction.id, attraction.name)"
                                        class="flex-1 flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors duration-200"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        Comentarios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Mensaje de no resultados -->
                <div x-show="attractions.length === 0" class="bg-white rounded-lg shadow-md p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">No se encontraron resultados</h3>
                    <p class="text-gray-500">Intenta con otra búsqueda o cambia los filtros aplicados</p>
                </div>
            </div>
        </div>

        <!-- Sidebar flotante de comentarios -->
        <div
            x-show="sidebarOpen"
            @click.away="sidebarOpen = false"
            class="fixed top-0 right-0 h-full w-full md:w-96 bg-white shadow-2xl border-l z-50 transform transition-transform duration-300"
            :class="{'translate-x-0': sidebarOpen, 'translate-x-full': !sidebarOpen}"
        >
            <div class="h-full flex flex-col">
                <div class="p-4 bg-indigo-700 text-white flex justify-between items-center">
                    <h3 class="text-lg font-semibold truncate" x-text="currentAttractionName"></h3>
                    <button @click="sidebarOpen = false" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Lista de comentarios -->
                <div class="flex-1 overflow-y-auto p-4">
                    <template x-if="comments.length === 0">
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M12 19c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                            </svg>
                            <p class="text-gray-500">No hay comentarios aún</p>
                            <p class="text-gray-400 text-sm">¡Sé el primero en compartir tu experiencia!</p>
                        </div>
                    </template>

                    <template x-for="(comment, index) in comments" :key="index">
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center mb-2">
                                <div class="bg-indigo-100 rounded-full p-2 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800" x-text="comment.user?.name || 'Usuario'"></p>
                                    <p class="text-xs text-gray-500" x-text="new Date(comment.created_at).toLocaleDateString()"></p>
                                </div>
                                <div class="ml-auto flex">
                                    <!-- Estrellas de calificación -->
                                    <template x-for="i in 5" :key="i">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            :class="i <= comment.rating ? 'text-yellow-400' : 'text-gray-300'"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </template>
                                </div>
                            </div>
                            <p class="text-gray-700" x-text="comment.comment"></p>
                        </div>
                    </template>
                </div>

                <!-- Formulario de comentarios -->
                <div class="border-t p-4 bg-gray-50">
                    <h4 class="font-medium text-gray-800 mb-2">Deja tu comentario</h4>

                    <div class="mb-3 flex justify-center">
                        <template x-for="i in 5" :key="i">
                            <button
                                @click="newRating = i"
                                class="focus:outline-none mx-1"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6"
                                    :class="i <= newRating ? 'text-yellow-400' : 'text-gray-300'"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </button>
                        </template>
                    </div>

                    <textarea
                        x-model="newComment"
                        placeholder="Comparte tu experiencia..."
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 mb-3"
                        rows="3"
                    ></textarea>

                    <button
                        @click="submitComment"
                        :disabled="newComment.trim() === ''"
                        :class="{'bg-indigo-600 hover:bg-indigo-700': newComment.trim() !== '', 'bg-gray-400 cursor-not-allowed': newComment.trim() === ''}"
                        class="w-full py-3 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200"
                    >
                        Enviar comentario
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function searchAndComments() {
            return {
                keyword: '',
                type: '',
                attractions: @json($attractions->items()),
                sidebarOpen: false,
                currentAttractionId: null,
                currentAttractionName: '',
                comments: [],
                newComment: '',
                newRating: 5,

                openSidebar(id, name) {
                    this.currentAttractionId = id;
                    this.currentAttractionName = name;
                    this.sidebarOpen = true;
                    this.loadComments();
                },

                loadComments() {
                    fetch(`/api/attractions/${this.currentAttractionId}/comments`)
                        .then(res => res.json())
                        .then(data => {
                            this.comments = data;
                        });
                },

                submitComment() {
                    if (this.newComment.trim() === '') return;

                    fetch(`/api/attractions/${this.currentAttractionId}/comment`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            comment: this.newComment,
                            rating: this.newRating
                        }),
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Error al enviar');
                        return res.json();
                    })
                    .then(data => {
                        this.newComment = '';
                        this.newRating = 5;
                        this.loadComments();
                    })
                    .catch(err => {
                        alert('Error al enviar el comentario: ' + err.message);
                    });
                },

                search() {
                    if(this.keyword.trim() === '' && this.type === '') {
                        this.attractions = @json($attractions->items());
                        return;
                    }

                    fetch(`/api/attractions/search?keyword=${encodeURIComponent(this.keyword)}&type=${encodeURIComponent(this.type)}`)
                        .then(res => res.json())
                        .then(data => {
                            this.attractions = data;
                        });
                },

                resetFilters() {
                    this.keyword = '';
                    this.type = '';
                    this.attractions = @json($attractions->items());
                }
            }
        }
    </script>
</x-app-layout>
