<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Http\Controllers\Mdt\HomePageController::class)->name('home')->withoutMiddleware('ActiveUnitCheck');
Route::post('/on-duty', \App\Http\Controllers\Mdt\OnDutyController::class)->name('onDuty')->withoutMiddleware('ActiveUnitCheck');
Route::post('/off-duty', \App\Http\Controllers\Mdt\OffDutyController::class)->name('offDuty');

Route::get('/dashboard', \App\Http\Controllers\Mdt\DashboardController::class)->name('dashboard');
Route::get('/cad-screen', \App\Http\Controllers\Mdt\CadScreenController::class)->name('cadScreen');
Route::get('/civilian-search/{civilian}', \App\Http\Controllers\Mdt\NameReturnController::class)->name('civilianReturn');
Route::get('/civilian-search', \App\Http\Controllers\Mdt\NameSearchController::class)->name('civilianSearch');
Route::post('/civilian-search/{civilian}/link-to-call', \App\Http\Controllers\Mdt\LinkCivilianToCallController::class)->name('civilianReturn.linkCivilianToCall');
Route::get('/vehicle-search/{vehicle:plate}', \App\Http\Controllers\Mdt\VehicleReturnController::class)->name('vehicleReturn');
Route::get('/vehicle-search', \App\Http\Controllers\Mdt\VehicleSearchController::class)->name('vehicleSearch');
Route::post('/vehicle-search/{vehicle:plate}/link-to-call', \App\Http\Controllers\Mdt\LinkVehicleToCallController::class)->name('vehicleReturn.linkVehicleToCall');
Route::get('/firearm-search', \App\Http\Controllers\Mdt\FirearmSearchController::class)->name('firearmSearch');

Route::get('calls', [\App\Http\Controllers\Mdt\CallController::class, 'index'])->name('calls.index');
Route::get('calls/create', [\App\Http\Controllers\Mdt\CallController::class, 'create'])->name('calls.create');
Route::post('calls', [\App\Http\Controllers\Mdt\CallController::class, 'store'])->name('calls.store');
Route::get('calls/{call}', [\App\Http\Controllers\Mdt\CallController::class, 'show'])->name('calls.show');
Route::put('calls/{call}', [\App\Http\Controllers\Mdt\CallController::class, 'update'])->name('calls.update');

Route::get('reports/create', [\App\Http\Controllers\Mdt\ReportController::class, 'create'])->name('reports.create');
Route::post('reports', [\App\Http\Controllers\Mdt\ReportController::class, 'store'])->name('reports.store');
Route::get('reports/{report}/edit', [\App\Http\Controllers\Mdt\ReportController::class, 'edit'])->name('reports.edit');
Route::post('reports/{report}', [\App\Http\Controllers\Mdt\ReportController::class, 'update'])->name('reports.update');
Route::post('reports/{report}', [\App\Http\Controllers\Mdt\ReportController::class, 'show'])->name('reports.show');
