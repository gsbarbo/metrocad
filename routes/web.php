<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Link\SteamLinkController;
use App\Http\Controllers\Portal\DashboardController;
use App\Http\Controllers\Portal\User\SettingsController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::view('/', 'home')->name('home');

Route::get('login/discord', function () {
    return Socialite::driver('discord')->redirect();
})->name('auth.discord')->middleware('guest');

Route::get('login/discord/handle', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth', 'MemberCheck', 'SteamLinkCheck'])->name('portal.')->prefix('portal')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/user/settings/edit', [SettingsController::class, 'edit'])->name('user.settings')->withoutMiddleware('SteamLinkCheck');

    Route::get('link/steam', function () {
        return Socialite::driver('steam')->redirect();
    })->name('link.steam')->withoutMiddleware('SteamLinkCheck');
    Route::get('link/steam/handle', [SteamLinkController::class, 'handle'])->name('portal.link.steam.handle')->withoutMiddleware('SteamLinkCheck');

    // Route::get('department/{department}', [DepartmentController::class, 'show'])->name('department.show');
    // Route::get('department/{department}/roster', [DepartmentController::class, 'roster'])->name('department.roster');

});

Route::middleware(['auth', 'MemberCheck', 'can:admin:access', 'SteamLinkCheck'])->name('admin.')->prefix('admin')->group(function () {
    require 'admin.php';
});
