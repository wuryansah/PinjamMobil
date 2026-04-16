<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::controller(ReportController::class)->group(function () {
    Route::get('/reports', 'index')->name('reports');
    Route::get('/reports/trip-history', 'tripHistory')->name('reports.report');
    Route::get('/reports/fuel', 'fuelReport')->name('reports.fuel');
});
