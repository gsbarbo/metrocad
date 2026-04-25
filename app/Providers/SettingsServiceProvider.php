<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\SettingsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function () {
            if (! Schema::hasTable('settings')) {
                return new SettingsService(collect());
            }

            $settings = Cache::rememberForever('settings', fn () => Setting::all()->toArray()
            );

            return new SettingsService(collect($settings));
        });
    }
}
