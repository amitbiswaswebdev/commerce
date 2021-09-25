<?php

namespace Easy\Theme;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Easy\Theme\Console\Commands\InstallTheme;
use Easy\Theme\View\Components\AppLayout;
use Easy\Theme\View\Components\GuestLayout;
use Easy\Theme\Http\Middleware\HandleInertiaRequests;

class ThemeServiceProvider extends ServiceProvider 
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
        $this->loadViewComponentsAs('easy-theme', [
            AppLayout::class,
            GuestLayout::class,
        ]);
        $this->loadViewsFrom(__DIR__.'/resources/views', 'easy-theme');
        $this->bootInertia();
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallTheme::class
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
