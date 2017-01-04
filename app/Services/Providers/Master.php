<?php

namespace GMC\Services\Providers;

use Illuminate\Support\ServiceProvider;

class Master extends ServiceProvider {
    
    public function register() {
        $this->app->singleton('Master', function() {
            return new GMC\Services\Containers\Master;
        });
    }
    
}
