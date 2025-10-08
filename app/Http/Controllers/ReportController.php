<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Datos de ventas
        $sales = $this->getSalesData($startDate, $endDate);

        // Estadísticas
        $totalSales = $sales->sum('total');
        $totalTransactions = $sales->count();
        $averageTicket = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        // Ventas por categoría
        $salesByCategory = $sales->groupBy('category')
            ->map(fn($items) => $items->sum('total'))
            ->sortDesc();

        // Ventas por día
        $salesByDay = $sales->groupBy(function($item) {
            return Carbon::parse($item['date'])->format('Y-m-d');
        })->map(fn($items) => $items->sum('total'));

        return view('reports.sales', compact(
            'sales',
            'totalSales',
            'totalTransactions',
            'averageTicket',
            'salesByCategory',
            'salesByDay',
            'startDate',
            'endDate'
        ));
    }

    public function exportPDF(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $sales = $this->getSalesData($startDate, $endDate);
        $totalSales = $sales->sum('total');
        $totalTransactions = $sales->count();

        $pdf = Pdf::loadView('reports.sales-pdf', compact(
            'sales',
            'totalSales',
            'totalTransactions',
            'startDate',
            'endDate'
        ));

        return $pdf->download('reporte-ventas.pdf');
    }

    private function getSalesData($startDate, $endDate)
    {
        // Datos de ejemplo
        return collect([
            ['id' => 1, 'date' => '2024-10-01', 'product' => 'Laptop Dell', 'category' => 'Electrónica', 'quantity' => 2, 'price' => 1200, 'total' => 2400],
            ['id' => 2, 'date' => '2024-10-02', 'product' => 'Mouse Logitech', 'category' => 'Accesorios', 'quantity' => 5, 'price' => 25, 'total' => 125],
            ['id' => 3, 'date' => '2024-10-03', 'product' => 'Teclado Mecánico', 'category' => 'Accesorios', 'quantity' => 3, 'price' => 80, 'total' => 240],
            ['id' => 4, 'date' => '2024-10-04', 'product' => 'Monitor LG 27"', 'category' => 'Electrónica', 'quantity' => 1, 'price' => 350, 'total' => 350],
            ['id' => 5, 'date' => '2024-10-05', 'product' => 'Webcam HD', 'category' => 'Accesorios', 'quantity' => 4, 'price' => 60, 'total' => 240],
            ['id' => 6, 'date' => '2024-10-06', 'product' => 'Smartphone Samsung', 'category' => 'Electrónica', 'quantity' => 2, 'price' => 800, 'total' => 1600],
            ['id' => 7, 'date' => '2024-10-07', 'product' => 'Audífonos Sony', 'category' => 'Audio', 'quantity' => 6, 'price' => 150, 'total' => 900],
        ]);
    }
}
