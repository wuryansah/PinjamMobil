<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::controller(DepartmentController::class)->group(function () {
    Route::get('/departments', 'index')->name('departments.index');
    Route::get('/departments/create', 'create')->name('departments.create');
    Route::post('/departments', 'store')->name('departments.store');
    Route::get('/departments/{department}', 'show')->name('departments.show');
    Route::get('/departments/{department}/edit', 'edit')->name('departments.edit');
    Route::patch('/departments/{department}', 'update')->name('departments.update');
    Route::delete('/departments/{department}', 'destroy')->name('departments.destroy');
});
