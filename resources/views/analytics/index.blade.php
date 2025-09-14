<x-app-layout>
    <div class="container">
        <h1>Gráficos de Modelo Predictivo</h1>

        <canvas id="featuresChart" height="100"></canvas>
        <canvas id="predictionsChart" height="100"></canvas>
        <canvas id="scatterChart" height="100"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const viewCounts = @json($data['view_counts']);
        const avgRatings = @json($data['avg_ratings']);
        const searchCounts = @json($data['search_counts']);
        const historyCounts = @json($data['history_counts']);
        const predictedClasses = @json($data['predicted_classes']);

        // Gráfico de características por usuario
        new Chart(document.getElementById('featuresChart'), {
            type: 'bar',
            data: {
                labels: [...Array(viewCounts.length).keys()],
                datasets: [
                    { label: 'Vistas', data: viewCounts, borderWidth: 1 },
                    { label: 'Rating Promedio', data: avgRatings, borderWidth: 1 },
                    { label: 'Búsquedas', data: searchCounts, borderWidth: 1 },
                    { label: 'Historial', data: historyCounts, borderWidth: 1 },
                ]
            },
            options: {
                responsive: true,
                plugins: { title: { display: true, text: 'Distribución de Características por Usuario' } }
            }
        });

        // Gráfico de predicciones por clase
        const predClassCount = predictedClasses.reduce((acc, val) => {
            acc[val] = (acc[val] || 0) + 1; return acc;
        }, {});
        new Chart(document.getElementById('predictionsChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(predClassCount),
                datasets: [{
                    label: 'Cantidad de Predicciones',
                    data: Object.values(predClassCount),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: { title: { display: true, text: 'Predicciones por Clase de Destino' } }
            }
        });

        // Gráfico scatter: vistas vs rating
        const scatterData = viewCounts.map((v, i) => ({ x: v, y: avgRatings[i], r: 5 }));
        new Chart(document.getElementById('scatterChart'), {
            type: 'bubble',
            data: {
                datasets: [{
                    label: 'Usuarios',
                    data: scatterData
                }]
            },
            options: {
                responsive: true,
                plugins: { title: { display: true, text: 'Vistas vs. Rating Promedio por Usuario' } },
                scales: {
                    x: { title: { display: true, text: 'Vistas' } },
                    y: { title: { display: true, text: 'Rating Promedio' } }
                }
            }
        });
    </script>
</x-app-layout>
