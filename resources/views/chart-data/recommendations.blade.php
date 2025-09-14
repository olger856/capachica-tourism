<x-app-layout>
    <div class="container">
        <h2>Recomendaciones por Categoría</h2>

        <div class="row">
            <div class="col-md-6">
                <canvas id="attractionsChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="destinationsChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Scripts directamente dentro del componente --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{ route('chart_data.recommendations') }}",
                method: 'GET',
                success: function (data) {
                    const attractionCtx = document.getElementById('attractionsChart').getContext('2d');
                    const destinationCtx = document.getElementById('destinationsChart').getContext('2d');

                    new Chart(attractionCtx, {
                        type: 'bar',
                        data: {
                            labels: data.attractionCategoriesLabels,
                            datasets: [{
                                label: 'Atracciones por Categoría',
                                data: data.attractionCategoriesData,
                                borderWidth: 1
                            }]
                        }
                    });

                    new Chart(destinationCtx, {
                        type: 'bar',
                        data: {
                            labels: data.destinationCategoriesLabels,
                            datasets: [{
                                label: 'Destinos por Categoría',
                                data: data.destinationCategoriesData,
                                borderWidth: 1
                            }]
                        }
                    });
                },
                error: function (xhr) {
                    console.error('Error al cargar los datos del gráfico:', xhr);
                }
            });
        });
    </script>
</x-app-layout>
