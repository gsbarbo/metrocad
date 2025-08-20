<?php

use App\Http\Controllers\Workbench\HomePageController;
use App\Http\Controllers\Workbench\OfficerController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class)->name('home');
Route::get('/officer', [OfficerController::class, 'index'])->name('officer.index');
Route::get('/officer/create', [OfficerController::class, 'create'])->name('officer.create');
Route::post('/officer', [OfficerController::class, 'store'])->name('officer.store');
Route::get('/officer/{officer}', [OfficerController::class, 'edit'])->name('officer.edit');
Route::post('/officer/{officer}', [OfficerController::class, 'update'])->name('officer.update');
