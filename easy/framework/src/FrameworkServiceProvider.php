<?php

namespace Easy\Framework;

use Illuminate\Support\ServiceProvider;
use Easy\Framework\Console\Commands\InstallFramework;
use Illuminate\Contracts\Support\DeferrableProvider;

class FrameworkServiceProvider extends ServiceProvider implements DeferrableProvider
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
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [InstallFramework::class];
    }
}
