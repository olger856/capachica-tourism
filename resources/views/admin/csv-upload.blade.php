<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-6" x-data="uploadHandler()">
        <div class="bg-white shadow-md rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">📤 Subir Archivos CSV</h2>

            <template x-if="successMessage">
                <div
                    x-text="successMessage"
                    x-show="showMessage"
                    @click="showMessage = false"
                    x-transition
                    class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4 cursor-pointer"
                ></div>
            </template>

            <template x-if="errorMessages.length > 0">
                <div
                    x-show="showMessage"
                    x-transition
                    class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4 cursor-pointer"
                    @click="showMessage = false"
                >
                    <ul class="list-disc pl-5 space-y-1">
                        <template x-for="error in errorMessages" :key="error">
                            <li x-text="error"></li>
                        </template>
                    </ul>
                </div>
            </template>

            <form
                method="POST"
                action="{{ route('admin.csv.upload') }}"
                enctype="multipart/form-data"
                class="space-y-5"
                @submit.prevent="submitForm"
            >
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Usuarios (CSV):</label>
                    <input type="file" name="users_csv" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" @change="clearMessages">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Destinos (CSV):</label>
                    <input type="file" name="destinations_csv" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" @change="clearMessages">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reseñas (CSV):</label>
                    <input type="file" name="reviews_csv" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" @change="clearMessages">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Historial (CSV):</label>
                    <input type="file" name="history_csv" required class="w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" @change="clearMessages">
                </div>

                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200"
                        :disabled="loading"
                    >
                        <template x-if="!loading">
                            <span>🚀 Subir CSVs</span>
                        </template>
                        <template x-if="loading">
                            <span>Cargando...</span>
                        </template>
                    </button>
                </div>

                <template x-if="loading">
                    <div class="mt-4">
                        <progress max="100" value="100" class="w-full"></progress>
                    </div>
                </template>
            </form>
        </div>
    </div>

    <script>
        function uploadHandler() {
            return {
                loading: false,
                successMessage: '',
                errorMessages: [],
                showMessage: true,
                submitForm() {
                    this.loading = true;
                    this.successMessage = '';
                    this.errorMessages = [];
                    this.showMessage = true;

                    const form = event.target;
                    const data = new FormData(form);

                    fetch(form.action, {
                        method: 'POST',
                        body: data,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(async response => {
                        this.loading = false;
                        if (!response.ok) {
                            const errorData = await response.json();
                            if (errorData.errors) {
                                this.errorMessages = Object.values(errorData.errors).flat();
                            } else if(errorData.message){
                                this.errorMessages = [errorData.message];
                            } else {
                                this.errorMessages = ['Error desconocido'];
                            }
                            return;
                        }
                        const res = await response.json();
                        this.successMessage = res.message || 'Archivos CSV importados correctamente.';
                        setTimeout(() => this.showMessage = false, 5000);
                    })
                    .catch(() => {
                        this.loading = false;
                        this.errorMessages = ['Error al conectar con el servidor.'];
                    });
                },
                clearMessages() {
                    this.successMessage = '';
                    this.errorMessages = [];
                    this.showMessage = true;
                }
            }
        }
    </script>
</x-app-layout>
