<?php

use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DiscordController;


Route::view('/', 'home');

// Route::get('login/discord/handle', function (HttpRequest $request) {
//     dd($request->all());
// })->name('discord.login.handler');



Route::get('/auth/discord', [DiscordController::class, 'redirect'])->name('auth.discord');
Route::get('/login/discord/handle', [DiscordController::class, 'callback'])->name('auth.discord.callback');
