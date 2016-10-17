<?php

namespace GMC\Services\Providers;

use Illuminate\Support\ServiceProvider;

class Vehicle extends ServiceProvider {
    
    public function register() {
        $this->app->singleton('Vehicle', function() {
            return new GMC\Services\Containers\Vehicle;
        });
    }
    
}
