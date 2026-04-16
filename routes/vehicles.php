<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::controller(VehicleController::class)->group(function () {
    Route::get('/vehicles', 'index')->name('vehicles.index');
    Route::post('/vehicles', 'store')->name('vehicles.store');
    Route::get('/vehicles/{vehicle}', 'show')->name('vehicles.show');
    Route::patch('/vehicles/{vehicle}', 'update')->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}', 'destroy')->name('vehicles.destroy');
});
