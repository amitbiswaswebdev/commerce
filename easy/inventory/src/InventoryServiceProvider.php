<?php

namespace Easy\Inventory;

use Illuminate\Support\ServiceProvider;
use Easy\Inventory\Contracts\SourceRepositoryInterface;
use Easy\Inventory\Service\SourceRepository;
class InventoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SourceRepositoryInterface::class, SourceRepository::class);

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
