<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\Mdt\HomePageController::class)->name('home');
Route::post('/on-duty', \App\Http\Controllers\Mdt\OnDutyController::class)->name('onDuty');
Route::get('/dashboard', \App\Http\Controllers\Mdt\DashboardController::class)->name('dashboard');
Route::get('/cad-screen', \App\Http\Controllers\Mdt\CadScreenController::class)->name('cadScreen');
Route::get('/civilian-search/{civilian}', \App\Http\Controllers\Mdt\NameReturnController::class)->name('civilianReturn');
Route::get('/civilian-search', \App\Http\Controllers\Mdt\NameSearchController::class)->name('civilianSearch');
Route::get('/vehicle-search/{vehicle}', \App\Http\Controllers\Mdt\VehicleReturnController::class)->name('vehicleReturn');
Route::get('/vehicle-search', \App\Http\Controllers\Mdt\VehicleSearchController::class)->name('vehicleSearch');
