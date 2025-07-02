<?php

use App\Http\Controllers\Civilian\CivilianController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CivilianController::class, 'index'])->name('index');
Route::get('create', [CivilianController::class, 'create'])->name('create');
Route::post('/', [CivilianController::class, 'store'])->name('store');
Route::get('{civilian}', [CivilianController::class, 'show'])->name('show');
Route::get('{civilian}/edit', [CivilianController::class, 'edit'])->name('edit');
Route::put('{civilian}', [CivilianController::class, 'update'])->name('update');
Route::delete('{civilian}', [CivilianController::class, 'destroy'])->name('destroy');
