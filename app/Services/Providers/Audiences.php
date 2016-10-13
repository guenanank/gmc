<?php

namespace GMC\Services\Providers;

use Illuminate\Support\ServiceProvider;

class Audiences extends ServiceProvider {

    public function register() {
        $this->app->singleton('Audiences', function() {
            return new GMC\Services\Containers\Audiences;
        });
    }

}
