<?php

namespace GMC\Services\Providers;

use Illuminate\Support\ServiceProvider;

class Residence extends ServiceProvider {
    
    public function register() {
        $this->app->singleton('Residence', function() {
            return new GMC\Services\Containers\Residence;
        });
    }
    
}
