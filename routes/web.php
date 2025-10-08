<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/reporte', [ReportController::class, 'index'])->name('reporte.index');
Route::get('/reporte/pdf', [ReportController::class, 'exportPDF'])->name('reporte.pdf');
Route::get('/', function () {
    return view('welcome');
});
