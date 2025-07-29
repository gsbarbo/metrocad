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

    Route::get('link/steam/handle', [SteamLinkController::class, 'handle'])->name('link.steam.handle')->withoutMiddleware('SteamLinkCheck');
    Route::get('link/steam/unlink', [SteamLinkController::class, 'unlink'])->name('link.steam.unlink')->withoutMiddleware('SteamLinkCheck');

    // Route::get('department/{department}', [DepartmentController::class, 'show'])->name('department.show');
    // Route::get('department/{department}/roster', [DepartmentController::class, 'roster'])->name('department.roster');

});

Route::middleware(['auth', 'MemberCheck', 'can:admin:access', 'SteamLinkCheck'])->name('admin.')->prefix('admin')->group(function () {
    require 'admin.php';
});

Route::middleware(['auth', 'MemberCheck', 'SteamLinkCheck'])->name('civilians.')->prefix('civilians')->group(function () {
    require 'civilian.php';
});

// Route::get('generateCsv', function () {
//     $vehicles = json_decode(file_get_contents('https://raw.githubusercontent.com/kevinldg/gtav-vehicle-database/refs/heads/main/data/vehicles.json'));

//     foreach ($vehicles as $vehicle) {
//         $import[] = [
//             'type' => ucfirst(strtolower($vehicle->Class)),
//             'make' => $vehicle->ManufacturerDisplayName->English,
//             'model' => $vehicle->DisplayName->English,
//             'price' => $vehicle->MonetaryValue,
//             'is_emergency_vehicle' => 0,
//             'spawn_code' => null,
//         ];
//     }

//     $format = json_encode($import);
//     dd($format);

// });
