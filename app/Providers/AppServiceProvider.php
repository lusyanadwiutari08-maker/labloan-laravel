<?php

namespace App\Providers;

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
        // Paksa URL HTTPS di produksi (hindari mixed-content di belakang SSL)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
