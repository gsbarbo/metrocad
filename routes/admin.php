<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Settings\DepartmentController;
use App\Http\Controllers\Admin\Settings\DiscordController;
use App\Http\Controllers\Admin\Settings\RoleController;
use App\Http\Controllers\Admin\Settings\VehicleTypeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('announcement', AnnouncementController::class)->except(['show'])->middleware('can:admin:announcement:access');
Route::resource('user', UserController::class)->except(['create', 'store'])->middleware('can:admin:user:access');

Route::name('settings.')->prefix('settings')->group(function () {
    Route::get('general', [SettingsController::class, 'general'])->name('general')->middleware('can:admin:settings:general');
    Route::get('civilian', [SettingsController::class, 'civilian'])->name('civilian')->middleware('can:admin:settings:general');
    Route::get('cad', [SettingsController::class, 'cad'])->name('cad')->middleware('can:admin:settings:general');
    Route::get('features', [SettingsController::class, 'features'])->name('features')->middleware('can:admin:settings:general');

    Route::get('vehicletype/import', [VehicleTypeController::class, 'import_view'])->name('vehicletype.import_view');
    Route::post('vehicletype/import', [VehicleTypeController::class, 'import'])->name('vehicletype.import');
    Route::resource('vehicletype', VehicleTypeController::class);

    Route::post('/', [SettingsController::class, 'update'])->name('update');

    Route::resource('role', RoleController::class)->middleware('can:admin:settings:management');
    Route::resource('departments', DepartmentController::class)->middleware('can:admin:settings:management');

    Route::get('discord', [DiscordController::class, 'index'])->name('discord.index')->middleware('can:admin:settings:discord');
    Route::post('discord', [DiscordController::class, 'update_guild_id'])->name('discord.update_guild_id')->middleware('can:admin:settings:discord');
    Route::get('discord/audit_log', [DiscordController::class, 'audit_log'])->name('discord.audit_log')->middleware('can:admin:settings:discord');
    Route::post('discord/audit_log', [DiscordController::class, 'update_channels'])->name('discord.update_channels')->middleware('can:admin:settings:discord');
    Route::get('discord/roles', [DiscordController::class, 'roles'])->name('discord.roles')->middleware('can:admin:settings:discord');

    Route::get('api_key', [SettingsController::class, 'api_key'])->name('api_key')->middleware('can:admin:settings:api_key');
    Route::get('generate_api_key', [SettingsController::class, 'generate_api_key'])->name('generate_api_key')->middleware('can:admin:settings:api_key');
});
