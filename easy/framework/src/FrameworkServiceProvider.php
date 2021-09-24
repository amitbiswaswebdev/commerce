<?php

namespace Easy\Framework;

use Illuminate\Support\ServiceProvider;
use Easy\Framework\Console\Commands\InstallFramework;

class FrameworkServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallFramework::class
            ]);
        }
    }
}
