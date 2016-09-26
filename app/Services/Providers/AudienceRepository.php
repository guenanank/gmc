<?php

namespace App\Services\Providers;

use Illuminate\Support\ServiceProvider;

class AudienceRepository extends ServiceProvider
{
     /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('AudienceRepository', function()
        {
            return new \App\Services\Containers\AudienceRepository;
        });
    }
    
}

