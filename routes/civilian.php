<?php

use App\Http\Controllers\Civilian\CivilianController;
use App\Http\Controllers\Civilian\FirearmController;
use App\Http\Controllers\Civilian\LicenseController;
use App\Http\Controllers\Civilian\MedicalRecordController;
use App\Http\Controllers\Civilian\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CivilianController::class, 'index'])->name('index');
Route::get('create', [CivilianController::class, 'create'])->name('create');
Route::post('/', [CivilianController::class, 'store'])->name('store');
Route::get('{civilian}', [CivilianController::class, 'show'])->name('show');
Route::get('{civilian}/edit', [CivilianController::class, 'edit'])->name('edit');
Route::put('{civilian}', [CivilianController::class, 'update'])->name('update');
Route::delete('{civilian}', [CivilianController::class, 'destroy'])->name('destroy');

Route::post('{civilian}/license', [LicenseController::class, 'store'])->name('license.store');
Route::post('{civilian}/vehicle', [VehicleController::class, 'store'])->name('vehicle.store');

Route::post('{civilian}/firearm', [FirearmController::class, 'store'])->name('firearm.store');
Route::delete('{civilian}/firearm/{firearm}', [FirearmController::class, 'destroy'])->name('firearm.destroy');

Route::post('{civilian}/medical-records', [MedicalRecordController::class, 'store'])->name('medicalRecords.store');
Route::delete('{civilian}/medical-records/{medicalRecord}', [MedicalRecordController::class, 'destroy'])->name('medicalRecords.destroy');
