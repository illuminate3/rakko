<?php
namespace TypiCMS\Modules\Menulinks\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Menulinks\Models\Menulink;
use TypiCMS\Modules\Menulinks\Repositories\CacheDecorator;
use TypiCMS\Modules\Menulinks\Repositories\EloquentMenulink;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.menulinks'
        );

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'menulinks');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'menulinks');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/menulinks'),
        ], 'views');
        $this->publishes([
            __DIR__ . '/../database' => base_path('database'),
        ], 'migrations');
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Menulinks\Providers\RouteServiceProvider');

        $app->bind('TypiCMS\Modules\Menulinks\Repositories\MenulinkInterface', function (Application $app) {
            $repository = new EloquentMenulink(new Menulink);
            if (! config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'menulinks', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

    }
}
