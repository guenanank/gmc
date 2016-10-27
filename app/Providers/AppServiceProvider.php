<?php

namespace GMC\Providers;

use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('greater_than', function($attribute, $value, $parameters) {
            $other = Input::get($parameters[0]);
            return isset($other) and (int) $value > (int) $other;
        });

        Validator::replacer('greater_than', function($message, $attribute, $rule, $parameters) {
            $string = preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/', ' $0', $parameters[0]);
            return str_replace(':field', strtolower($string), $message);
        });
        
        if(!\App::environment('local')) {
            \URL::forceSchema('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
