<?php

namespace App\Services\Providers;

use Illuminate\Support\ServiceProvider;

class AudienceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    
     /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('AudienceContainer', function()
        {
            return new \App\Services\Containers\AudienceContainer;
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [\App\Services\Containers\AudienceContainer::class];
    }
}

