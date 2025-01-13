<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::view('/', 'home');

Route::get('login/discord', function () {
    return Socialite::driver('discord')->redirect();
})->name('auth.discord')->middleware('guest');

Route::get('login/discord/handle', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
