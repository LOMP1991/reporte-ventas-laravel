<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">📊 Reporte de Ventas</h1>

            <form method="GET" action="{{ route('reporte.index') }}" class="flex gap-4 mb-4 flex-wrap">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                    <input type="date" name="start_date" value="{{ $startDate }}"
                           class="mt-1 border rounded-md px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                    <input type="date" name="end_date" value="{{ $endDate }}"
                           class="mt-1 border rounded-md px-3 py-2">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        🔍 Filtrar
                    </button>
                </div>
            </form>

            <div class="flex gap-2">
                <a href="{{ route('reporte.pdf') }}"
                   class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 inline-block">
                    📄 Exportar PDF
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-gray-500 text-sm font-medium">💰 Total Ventas</h3>
                <p class="text-3xl font-bold text-green-600">${{ number_format($totalSales, 2) }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-gray-500 text-sm font-medium">🛒 Transacciones</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $totalTransactions }}</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-gray-500 text-sm font-medium">📈 Ventas Por Promedio</h3>
                <p class="text-3xl font-bold text-purple-600">${{ number_format($averageTicket, 2) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Ventas por Categoría</h3>
                <canvas id="categoryChart" height="200"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Ventas por Día</h3>
                <canvas id="dailyChart" height="200"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">📋 Detalle de Ventas</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoría</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sales as $sale)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $sale['date'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $sale['product'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $sale['category'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">{{ $sale['quantity'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">${{ number_format($sale['price'], 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">
                                ${{ number_format($sale['total'], 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-right font-bold">TOTAL:</td>
                            <td class="px-6 py-4 font-bold text-green-600 text-lg">
                                ${{ number_format($totalSales, 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Gráfico de categorías
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($salesByCategory->keys()) !!},
                datasets: [{
                    data: {!! json_encode($salesByCategory->values()) !!},
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true
            }
        });

        // Gráfico diario
        const dailyCtx = document.getElementById('dailyChart').getContext('2d');
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($salesByDay->keys()) !!},
                datasets: [{
                    label: 'Ventas Diarias ($)',
                    data: {!! json_encode($salesByDay->values()) !!},
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
