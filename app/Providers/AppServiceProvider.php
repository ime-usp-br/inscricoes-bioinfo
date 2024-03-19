<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (env('FORCE_HTTPS') === true) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        if (env('FORCE_HTTPS', false)){
            URL::forceScheme('https');
        }    

        if ($this->app->environment('local') || $this->app->environment('development')) {
            Mail::alwaysTo(env('MAIL_DEV_TEST'));
        }
    }
}
