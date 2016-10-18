<?php

namespace GMC\Services\Providers;

use Illuminate\Support\ServiceProvider;

class Audience extends ServiceProvider {

    public function register() {
        $this->app->singleton('Audience', function() {
            return new GMC\Services\Containers\Audience;
        });
    }

}
