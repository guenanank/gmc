<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AudienceServiceProvider extends ServiceProvider
{
     /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('AudienceServiceContainer', function()
        {
            return new \App\Containers\AudienceServiceContainer;
        });
    }
    
}

