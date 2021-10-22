<?php

namespace Easy\Inventory;

use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/menu.php', 'menu'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/inventory.php');
        $this->publishes([
            __DIR__.'/../stubs/resources/js' => resource_path('js'),
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'inventory');
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'inventory-migration');
        $this->publishes([
            __DIR__.'/../stubs/resources/js' => resource_path('js')
        ], 'inventory-views');
    }
}
