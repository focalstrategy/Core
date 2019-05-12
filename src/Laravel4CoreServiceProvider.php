<?php

namespace FocalStrategy\Core;

use Illuminate\Support\ServiceProvider;
use View;

require_once __DIR__.'/helpers.php';

class Laravel4CoreServiceProvider extends ServiceProvider
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
        View::addNamespace('core', __DIR__.'/views_4');
    }
}
