<?php

namespace Easy\Customer;

use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
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
        ], 'customer');
    }
}
