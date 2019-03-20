<?php

namespace FocalStrategy\Core;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'core');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/core'),
        ]);
    }
}
