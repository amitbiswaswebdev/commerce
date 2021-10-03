<?php

namespace Easy\Catalog;

use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/routes/customer.php');
        $this->publishes([
            __DIR__.'/../stubs/resources/views' => resource_path('views')
        ], 'customer-views');
    }
}
