<?php

use App\Http\Controllers\Workbench\HomePageController;
use App\Http\Controllers\Workbench\NewOfficerController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class)->name('home');
Route::get('/officer/create', [NewOfficerController::class, 'create'])->name('newOfficer.create')->withoutMiddleware(['NewOfficerCheck']);
Route::post('/officer', [NewOfficerController::class, 'store'])->name('newOfficer.store')->withoutMiddleware(['NewOfficerCheck']);
