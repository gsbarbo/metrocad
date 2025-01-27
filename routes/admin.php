<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('announcement', AnnouncementController::class)->except(['show'])->middleware('can:admin:announcement:access');
Route::resource('user', UserController::class)->except(['create', 'store'])->middleware('can:admin:user:access');
