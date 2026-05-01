<?php

use App\Http\Controllers\Auth\DiscordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Portal\DashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home')->middleware('guest');

Route::get('/auth/discord', [DiscordController::class, 'redirect'])->name('auth.discord');
Route::get('/auth/discord/callback', [DiscordController::class, 'callback'])->name('auth.discord.callback');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::middleware(['auth', 'status.access'])->prefix('status')->name('status.')->group(function () {
    Route::view('/pending', 'status', ['status' => 'Pending', 'description' => 'Your application is pending review. A staff member will evaluate your account shortly.'])->name('pending');
    Route::view('/banned', 'status', ['status' => 'Banned', 'description' => 'Your account has been permanently banned from this community. Contact staff if you believe this is a mistake.'])->name('banned');
    Route::view('/denied', 'status', ['status' => 'Denied', 'description' => 'Your application has been denied. Please contact staff for more information.'])->name('denied');
    Route::view('/suspended', 'status', ['status' => 'Suspended', 'description' => 'Your account has been temporarily suspended. Please contact staff to resolve this.'])->name('suspended');
    Route::view('/inactive', 'status', ['status' => 'Inactive', 'description' => 'Your account is currently inactive. Contact staff to restore access.'])->name('inactive');
});

Route::group(['middleware' => ['auth', 'cad.access'], 'prefix' => 'portal'], function () {

    Route::get('/dashboard', DashboardController::class)->name('portal.dashboard');

});
