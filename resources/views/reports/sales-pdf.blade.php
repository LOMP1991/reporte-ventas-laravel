<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 20px;
        }
        .stats {
            margin: 20px 0;
            background: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-row {
            background-color: #4CAF50 !important;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 Reporte de Ventas</h1>
        <p><strong>Período:</strong> {{ $startDate }} al {{ $endDate }}</p>
    </div>

    <div class="stats">
        <p><strong>💰 Total Ventas:</strong> ${{ number_format($totalSales, 2) }}</p>
        <p><strong>🛒 Total Transacciones:</strong> {{ $totalTransactions }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Producto</th>
                <th>Categoría</th>
                <th>Cantidad</th>
                <th>Precio Unit.</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale['date'] }}</td>
                <td>{{ $sale['product'] }}</td>
                <td>{{ $sale['category'] }}</td>
                <td style="text-align: center;">{{ $sale['quantity'] }}</td>
                <td>${{ number_format($sale['price'], 2) }}</td>
                <td><strong>${{ number_format($sale['total'], 2) }}</strong></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="5" style="text-align: right;"><strong>TOTAL GENERAL:</strong></td>
                <td><strong>${{ number_format($totalSales, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 30px; text-align: center; font-size: 10px; color: #666;">
        <p>Reporte generado el {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
