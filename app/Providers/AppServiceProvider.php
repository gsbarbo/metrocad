<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
            $event->extendSocialite('steam', \SocialiteProviders\Steam\Provider::class);

        });

        $this->app->bind('settings', function () {
            return Cache::rememberForever('settings', function () {
                return DB::table('settings')->get(['name', 'value']);
            });
        });

        Gate::before(function ($user, $ability) {
            return ($user->is_owner || $user->is_super_user) ? true : null;
        });

        $this->configureModels();
        $this->configureUrl();
    }

    private function configureModels()
    {
        Model::shouldBeStrict();
        Model::unguard();
    }

    private function configureUrl()
    {
        URL::forceScheme('https');
    }
}
