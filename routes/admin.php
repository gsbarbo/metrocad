<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Settings\DepartmentController;
use App\Http\Controllers\Admin\Settings\DiscordController;
use App\Http\Controllers\Admin\Settings\RoleController;
use App\Http\Controllers\Admin\Settings\Values\AddressController;
use App\Http\Controllers\Admin\Settings\Values\LicensesController;
use App\Http\Controllers\Admin\Settings\VehicleTypeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\User\UserDepartmentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('announcement', AnnouncementController::class)->except(['show'])->middleware('can:admin:announcement:access');

Route::name('user.userDepartments.')->prefix('user/{user}/user-departments')->middleware('can:admin:settings:values')->group(function () {
    Route::get('/', [UserDepartmentController::class, 'index'])->name('index');
    Route::get('create', [UserDepartmentController::class, 'create'])->name('create');
    Route::post('/', [UserDepartmentController::class, 'store'])->name('store');
    Route::get('{userDepartment}/edit', [UserDepartmentController::class, 'edit'])->name('edit');
    Route::put('{userDepartment}', [UserDepartmentController::class, 'update'])->name('update');
    Route::delete('{userDepartment}', [UserDepartmentController::class, 'destroy'])->name('destroy');
});
Route::resource('user', UserController::class)->except(['create', 'store'])->middleware('can:admin:user:access');

Route::name('settings.')->prefix('settings')->group(function () {
    Route::get('general', [SettingsController::class, 'general'])->name('general')->middleware('can:admin:settings:general');
    Route::get('civilian', [SettingsController::class, 'civilian'])->name('civilian')->middleware('can:admin:settings:general');
    Route::get('mdt', [SettingsController::class, 'cad'])->name('mdt')->middleware('can:admin:settings:general');
    Route::get('features', [SettingsController::class, 'features'])->name('features')->middleware('can:admin:settings:general');

    Route::get('vehicletype/import', [VehicleTypeController::class, 'import_view'])->name('vehicletype.import_view');
    Route::post('vehicletype/import', [VehicleTypeController::class, 'import'])->name('vehicletype.import');
    Route::resource('vehicletype', VehicleTypeController::class);

    Route::name('licenseValues.')->prefix('license-values')->middleware('can:admin:settings:values')->group(function () {
        Route::get('/', [LicensesController::class, 'index'])->name('index');
        Route::get('create', [LicensesController::class, 'create'])->name('create');
        Route::post('/', [LicensesController::class, 'store'])->name('store');
        Route::get('{licenseValue}/edit', [LicensesController::class, 'edit'])->name('edit');
        Route::put('{licenseValue}', [LicensesController::class, 'update'])->name('update');
        Route::delete('{licenseValue}', [LicensesController::class, 'destroy'])->name('destroy');
    });

    Route::name('addresses.')->prefix('addresses')->middleware('can:admin:settings:values')->group(function () {
        Route::get('/', [AddressController::class, 'index'])->name('index');
        Route::get('create', [AddressController::class, 'create'])->name('create');
        Route::post('/', [AddressController::class, 'store'])->name('store');
        Route::get('{address}/edit', [AddressController::class, 'edit'])->name('edit');
        Route::put('{address}', [AddressController::class, 'update'])->name('update');
        Route::delete('{address}', [AddressController::class, 'destroy'])->name('destroy');
        Route::post('import', [AddressController::class, 'import'])->name('import');
    });

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
