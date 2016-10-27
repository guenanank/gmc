<?php

namespace App\Providers;

use Collective\Html\HtmlBuilder;
use Collective\Html\FormBuilder;
use Collective\Html\HtmlServiceProvider as BaseHtmlServiceProvider;

class HtmlServiceProvider extends BaseHtmlServiceProvider {

    protected function registerHtmlBuilder() {
        $this->app->singleton('html', function($app) {
            // Fetch the default UrlGenerator
            $url = $app['url'];
            if (!$this->app->environment('local')) {
                $url = $app->make('Illuminate\Routing\UrlGenerator');
                $url->forceSchema('https');
            }

            return new HtmlBuilder($url, $app['view']);
        });
    }

    protected function registerFormBuilder() {
        $this->app->singleton('form', function($app) {
            $url = $app['url'];
            if (!$this->app->environment('local')) {
                $url = $app->make('Illuminate\Routing\UrlGenerator');
                $url->forceSchema('https');
            }

            $form = new FormBuilder($app['html'], $url, $app['view'], $app['session.store']->getToken());

            return $form->setSessionStore($app['session.store']);
        });
    }

}
