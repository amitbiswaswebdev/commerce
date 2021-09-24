<?php

namespace Easy\Framework;

use Illuminate\Support\ServiceProvider;
use Easy\Framework\Console\Commands\InstallFramework;
use Easy\Framework\Http\Middleware\HandleInertiaRequests;
use Illuminate\Contracts\Http\Kernel;

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
        $this->bootInertia();
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallFramework::class
            ]);
        }
    }

    protected function bootInertia()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', HandleInertiaRequests::class);
        $kernel->appendToMiddlewarePriority(HandleInertiaRequests::class);
    }
}
