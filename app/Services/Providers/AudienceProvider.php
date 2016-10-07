<?php

namespace GMC\Services\Providers;

use Illuminate\Support\ServiceProvider;

class AudienceProvider extends ServiceProvider {

    protected $defer = true;

    public function boot() {
        //
    }

    public function register() {
        $this->app->singleton('AudienceContainer', function() {
            return new \GMC\Services\Containers\AudienceContainer;
        });
    }

    public function provides() {
        return [\GMC\Services\Containers\AudienceContainer::class];
    }

}
