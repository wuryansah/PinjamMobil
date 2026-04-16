<?php

use App\Http\Controllers\VehicleRequestController;
use Illuminate\Support\Facades\Route;

Route::controller(VehicleRequestController::class)->group(function () {
    Route::get('/requests', 'index')->name('requests.index');
    Route::get('/requests/create', 'create')->name('requests.create');
    Route::post('/requests', 'store')->name('requests.store');
    Route::get('/requests/{vehicleRequest}', 'show')->name('requests.show');

    Route::post('/requests/{vehicleRequest}/manager-approve', 'managerApprove')
        ->middleware('role:manager')
        ->name('requests.manager-approve');

    Route::post('/requests/{vehicleRequest}/admin-assign', 'adminAssign')
        ->middleware('role:admin')
        ->name('requests.admin-assign');

    Route::post('/requests/{vehicleRequest}/start-trip', 'startTrip')
        ->middleware('role:driver')
        ->name('requests.start-trip');

    Route::post('/requests/{vehicleRequest}/update-start-km', 'updateStartKm')
        ->middleware('role:driver')
        ->name('requests.update-start-km');

    Route::post('/requests/{vehicleRequest}/start-trip-simple', 'startTripSimple')
        ->middleware('role:driver')
        ->name('requests.start-trip-simple');

    Route::post('/requests/{vehicleRequest}/end-trip-simple', 'endTripSimple')
        ->middleware('role:driver')
        ->name('requests.end-trip-simple');

    Route::post('/requests/{vehicleRequest}/complete', 'complete')
        ->middleware('role:driver')
        ->name('requests.complete');

    Route::post('/requests/{vehicleRequest}/admin-start-trip', 'adminStartTrip')
        ->middleware('role:admin')
        ->name('requests.admin-start-trip');

    Route::post('/requests/{vehicleRequest}/admin-end-trip', 'adminEndTrip')
        ->middleware('role:admin')
        ->name('requests.admin-end-trip');

    Route::post('/requests/{vehicleRequest}/cancel', 'cancel')
        ->middleware('role:driver')
        ->name('requests.cancel');
});
