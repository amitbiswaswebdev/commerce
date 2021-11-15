<?php

namespace Easy\Theme;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Easy\Theme\Console\Commands\InstallTheme;
use Easy\Theme\View\Components\AppLayout;
use Easy\Theme\View\Components\GuestLayout;
use Easy\Theme\Http\Middleware\HandleInertiaRequests;
use Easy\Theme\Service\MergeConfig;
use Easy\Theme\Contracts\TreeInterface;
use Easy\Theme\Service\Tree;
use Easy\Theme\Contracts\FileUploadInterface;
use Easy\Theme\Service\FileUpload;
class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TreeInterface::class, Tree::class);
        $this->app->singleton(FileUploadInterface::class, FileUpload::class);
        $this->mergeConfigFileFrom(__DIR__ . '/../config/app.php', 'app');
        $replace = config('preference');
        if (is_array($replace) && sizeof($replace) ) {
            foreach ($replace as $source => $destination) {
                $this->app->bind($source, $destination);
            }
        }
        // $extends = config('preference.extends');
        // if (is_array($extends) && sizeof($extends) ) {
        //     foreach ($extends as $source => $destination) {
        //         $this->app->extend($source, $destination);
        //     }
        // }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
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

            $this->publishes([
                __DIR__.'/../stubs/resources' => resource_path('/'),
                __DIR__.'/../config/menu.php' => config_path('menu.php'),
                __DIR__.'/../config/preference.php' => config_path('preference.php')
            ], 'theme');
        }
    }

    /**
     * @throws BindingResolutionException
     */
    protected function bootInertia()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->appendMiddlewareToGroup('web', HandleInertiaRequests::class);
        $kernel->appendToMiddlewarePriority(HandleInertiaRequests::class);
    }

    /**
     * mergeConfigFileFrom
     *
     * @param mixed $path
     * @param mixed $key
     * @return void
     */
    protected function mergeConfigFileFrom($path, $key)
    {
        $mergeConfigInterface = new MergeConfig();
        $original = $this->app['config']->get($key, []);
        $this->app['config']->set(
            $key,
            $mergeConfigInterface->multiLevelArrayMerge(
                require $path,
                $original
            )
        );
    }
}
