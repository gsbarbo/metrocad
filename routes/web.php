<?php

use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Portal\DashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home')->middleware('guest');

Route::get('/auth/discord', [DiscordController::class, 'redirect'])->name('auth.discord');
Route::get('/auth/discord/callback', [DiscordController::class, 'callback'])->name('auth.discord.callback');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::group(['middleware' => ['auth'], 'prefix' => 'portal'], function () {

    Route::get('/dashboard', DashboardController::class)->name('portal.dashboard');

});
