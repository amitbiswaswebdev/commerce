<?php

namespace Easy\Product;

use Illuminate\Support\ServiceProvider;
use Easy\Product\Service\ProductRepository;
use Easy\Product\Contracts\ProductRepositoryInterface;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductRepositoryInterface::class, ProductRepository::class);
        $this->mergeConfigFrom(
            __DIR__.'/../config/preference.php', 'preference'
        );
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
        $this->loadRoutesFrom(__DIR__.'/routes/product.php');
        $this->publishes([
            __DIR__.'/../stubs/resources/js' => resource_path('js'),
            __DIR__.'/../database/migrations/' => database_path('migrations'),
            __DIR__.'/../config/product_type.php' => config_path('product_type.php')
        ], 'product');
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'product-migration');
        $this->publishes([
            __DIR__.'/../stubs/resources/js' => resource_path('js')
        ], 'product-views');
    }
}
