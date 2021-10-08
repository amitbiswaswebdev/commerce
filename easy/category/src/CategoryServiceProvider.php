<?php

namespace Easy\Category;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/routes/category.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../stubs/resources/js' => resource_path('js'),
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'category');
        }
    }
}
