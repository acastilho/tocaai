<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // No localhost (env local), ele NÃO força HTTPS
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
