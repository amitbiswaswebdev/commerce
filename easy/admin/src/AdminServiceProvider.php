<?php

namespace Easy\Admin;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\Authenticate as CoreAuthenticate;
use App\Http\Middleware\RedirectIfAuthenticated as CoreRedirectIfAuthenticated;
use Easy\Admin\Http\Middleware\Authenticate;
use Easy\Admin\Http\Middleware\RedirectIfAuthenticated;

class AdminServiceProvider extends ServiceProvider
{
    
    /**
     * The path to the "admin dashboard" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const ADMIN_HOME = '/admin/dashboard';
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CoreAuthenticate::class, Authenticate::class);
        $this->app->singleton(CoreRedirectIfAuthenticated::class, RedirectIfAuthenticated::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //composer config repositories.admin '{"type": "path", "url": "./package/easy/admin"}' --file composer.json

        $this->mergeConfigFileFrom(__DIR__ . '/config/auth.php', 'auth');

        $this->loadRoutesFrom(__DIR__.'/routes/admin.php');
        $this->publishes([
            __DIR__.'/../stubs/resources/js' => resource_path('js')
        ], 'admin-views');
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'admin-migrations');
    }

    protected function mergeConfigFileFrom($path, $key)
    {
        $original = $this->app['config']->get($key, []);
        $this->app['config']->set($key, $this->multiLevelArrayMerge(require $path, $original));
    }

    protected function multiLevelArrayMerge($toMerge, $original)
    {
        $auth = [];
        foreach ($original as $key => $value) {
            if (isset($toMerge[$key]) && is_array($value)) {
                $auth[$key] = array_merge($value, $toMerge[$key]);
            }
            elseif (isset($toMerge[$key])) {
                $auth[$key] = $toMerge[$key];
            } 
            else {
                $auth[$key] = $value;
            }
        }
        
        return $auth;
    }
}
