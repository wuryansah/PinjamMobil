<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Vehicles
    Route::middleware('role:admin')->group(function () {
        Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
        Route::match(['PUT', 'PATCH'], '/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
        Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    });

    // Requests
    Route::get('/requests', [VehicleRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [VehicleRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [VehicleRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{vehicleRequest}', [VehicleRequestController::class, 'show'])->name('requests.show');
    Route::get('/requests/{vehicleRequest}/edit', [VehicleRequestController::class, 'edit'])->name('requests.edit');
    Route::match(['PUT', 'PATCH'], '/requests/{vehicleRequest}', [VehicleRequestController::class, 'update'])->name('requests.update');
    Route::delete('/requests/{vehicleRequest}', [VehicleRequestController::class, 'destroy'])->name('requests.destroy');
    Route::post('/requests/{vehicleRequest}/manager-approve', [VehicleRequestController::class, 'managerApprove'])->name('requests.manager-approve')->middleware('role:manager');
    Route::post('/requests/{vehicleRequest}/admin-assign', [VehicleRequestController::class, 'adminAssign'])->name('requests.admin-assign')->middleware('role:admin');
    Route::post('/requests/{vehicleRequest}/start-trip', [VehicleRequestController::class, 'startTrip'])->name('requests.start-trip')->middleware('role:driver');
    Route::post('/requests/{vehicleRequest}/start-trip-simple', [VehicleRequestController::class, 'startTripSimple'])->name('requests.start-trip-simple')->middleware('role:driver');
    Route::post('/requests/{vehicleRequest}/end-trip-simple', [VehicleRequestController::class, 'endTripSimple'])->name('requests.end-trip-simple')->middleware('role:driver');
    Route::post('/requests/{vehicleRequest}/complete', [VehicleRequestController::class, 'complete'])->name('requests.complete')->middleware('role:driver');
    Route::post('/requests/{vehicleRequest}/admin-start-trip', [VehicleRequestController::class, 'adminStartTrip'])->name('requests.admin-start-trip')->middleware('role:admin');
    Route::post('/requests/{vehicleRequest}/admin-end-trip', [VehicleRequestController::class, 'adminEndTrip'])->name('requests.admin-end-trip')->middleware('role:admin');
    Route::post('/requests/{vehicleRequest}/cancel', [VehicleRequestController::class, 'cancel'])->name('requests.cancel')->middleware('role:driver');
    Route::post('/requests/{vehicleRequest}/update-start-km', [VehicleRequestController::class, 'updateStartKm'])->name('requests.update-start-km')->middleware('role:driver');

    // Fuels
    Route::middleware('role:admin,driver')->group(function () {
        Route::get('/fuels', [FuelController::class, 'index'])->name('fuels.index');
        Route::get('/fuels/create', [FuelController::class, 'create'])->name('fuels.create');
        Route::post('/fuels', [FuelController::class, 'store'])->name('fuels.store');
        Route::get('/fuels/{fuelRecord}', [FuelController::class, 'show'])->name('fuels.show')->withoutMiddleware('role:admin,driver');
        Route::get('/fuels/{fuelRecord}/edit', [FuelController::class, 'edit'])->name('fuels.edit');
        Route::post('/fuels-update/{fuelRecord}', [FuelController::class, 'update'])->name('fuels.update');
        Route::post('/fuels-destroy/{fuelRecord}', [FuelController::class, 'destroy'])->name('fuels.destroy');
    });

    // Reports
    Route::middleware('role:admin')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        Route::get('/reports/trip-history', [ReportController::class, 'tripHistory'])->name('reports.report');
        Route::get('/reports/fuel', [ReportController::class, 'fuelReport'])->name('reports.fuel');
    });

    // Departments
    Route::middleware('role:admin')->group(function () {
        Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
        Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::match(['PUT', 'PATCH'], '/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    });

    // Users
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        // Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show'); // show is not in controller
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::match(['PUT', 'PATCH'], '/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');
    Route::get('/notifications/{notification}/click', [NotificationController::class, 'click'])->name('notifications.click');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['PUT', 'PATCH'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
