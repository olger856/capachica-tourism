<x-app-layout>
    <div class="min-h-screen relative overflow-x-hidden bg-gradient-animated text-white">
        <!-- Partículas animadas -->
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>

        <!-- Patrón de cuadrícula -->
        <div class="grid-pattern fixed inset-0 z-0 pointer-events-none"></div>

        <!-- Header -->
        <header class="header-premium relative z-10 p-8 mb-10">
            <div class="container mx-auto flex justify-between items-center">
                <div class="floating-slow">
                    <h1 class="text-5xl font-black text-yellow-400 mb-3">🚀 Analytics Pro</h1>
                    <p class="text-xl text-yellow-100">Inteligencia de datos avanzada en tiempo real</p>
                </div>
                <div class="text-right">
                    <p class="text-lime-400 font-semibold text-lg">Sistema Activo</p>
                    <p class="text-lime-200 text-sm">Latencia: 12ms</p>
                </div>
            </div>
        </header>

        <!-- Métricas principales -->
        <main class="container mx-auto px-8 pb-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Tarjeta 1 -->
                <div class="card-premium p-8 rounded-2xl bg-slate-900/80">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-yellow-100 text-sm uppercase">Total Registros</p>
                            <p class="metric-number text-white">12,543</p>
                            <p class="text-green-400 text-sm">↗ +2.5% vs ayer</p>
                        </div>
                        <div class="stats-icon p-4 rounded-2xl bg-gray-800">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2" />
                            </svg>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full"></div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="card-premium p-8 rounded-2xl bg-slate-900/80">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-yellow-100 text-sm uppercase">Crecimiento</p>
                            <p class="metric-number text-green-300">+24.5%</p>
                            <p class="text-green-200 text-sm">🎯 Meta superada</p>
                        </div>
                        <div class="stats-icon p-4 rounded-2xl bg-gray-800">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-green-400 to-teal-400 rounded-full"></div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="card-premium p-8 rounded-2xl bg-slate-900/80">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <p class="text-yellow-100 text-sm uppercase">Actualización</p>
                            <p class="metric-number text-fuchsia-300">2 min</p>
                            <p class="text-blue-200 text-sm">⚡ Sincronizado</p>
                        </div>
                        <div class="stats-icon p-4 rounded-2xl bg-gray-800">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="h-1 bg-gradient-to-r from-pink-400 to-violet-400 rounded-full"></div>
                </div>
            </div>

            <!-- Dashboard Power BI -->
            <section class="glass-morphism rounded-3xl p-10 bg-slate-800/90">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-white">Power BI Dashboard - Restaurantes</h2>
                        <p class="text-gray-100 text-lg">Análisis inteligente y visualización de datos críticos</p>
                    </div>
                    <div class="flex space-x-4">
                        <button id="btn-exportar" class="button-futuristic px-6 py-3 rounded-xl">Exportar</button>
                        <button class="button-futuristic px-6 py-3 rounded-xl">Actualizar</button>
                    </div>
                </div>
                <div class="iframe-advanced">
                    <iframe
                        id="dashboardIframe"
                        title="AVANCE1"
                        src="https://app.powerbi.com/view?r=eyJrIjoiNDdiMGQ0ODAtOTg4YS00OTQ4LWJkNjAtMTE5YmFjNzkyMTdhIiwidCI6ImNmYmQ4OGI0LTk0YmMtNGZiYS05OGJkLTY0ZDA3MjYzOTRhMyIsImMiOjR9"
                        allowfullscreen
                        class="w-full h-[700px] bg-white rounded-2xl">
                    </iframe>
                </div>
            </section>

            <!-- Footer -->
            <footer class="mt-12 text-center text-gray-300 text-sm">
                © 2025 Analytics Pro Dashboard — Powered by AI
            </footer>
        </main>
    </div>

    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
        <style>
            .bg-gradient-animated {
                background: linear-gradient(135deg, #0f0f0f, #111827, #1f2937, #0f0f0f) !important;
                background-size: 400% 400%;
                animation: gradientShift 12s ease infinite;
                background-attachment: fixed;
                color: #ffffff !important;
            }

            @keyframes gradientShift {
                0% {
                    background-position: 0% 50%;
                }
                50% {
                    background-position: 100% 50%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
        <script>
            document.getElementById('btn-exportar').addEventListener('click', function () {
                const iframe = document.getElementById('dashboardIframe');
                const iframeContainer = iframe.parentNode;

                html2canvas(iframeContainer, {
                    useCORS: true,
                    scale: 2
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'dashboard_export.png';
                    link.href = canvas.toDataURL();
                    link.click();
                });
            });
        </script>
    @endpush
</x-app-layout>
