<?php
namespace TypiCMS\Modules\Menus\Providers;

use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Log;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;
use TypiCMS\Modules\Menus\Models\Menu;
use TypiCMS\Modules\Menus\Repositories\CacheDecorator;
use TypiCMS\Modules\Menus\Repositories\EloquentMenu;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {

        $this->storeAllMenus();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.menus'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['menus' => []], $modules));

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'menus');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'menus');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/menus'),
        ], 'views');
        $this->publishes([
            __DIR__ . '/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Menus',
            'TypiCMS\Modules\Menus\Facades\Facade'
        );

    }

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Menus\Providers\RouteServiceProvider');

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Menus\Composers\SidebarViewComposer');

        $app->bind('TypiCMS\Modules\Menus\Repositories\MenuInterface', function (Application $app) {
            $repository = new EloquentMenu(new Menu);
            if (! config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], ['menus', 'menulinks', 'pages'], 10);

            return new CacheDecorator($repository, $laravelCache);
        });
    }

    /**
     * Store all menus in container
     *
     * @return void
     */
    private function storeAllMenus()
    {
        try {
            $with = [
                'translations',
                'menulinks' => function(HasMany $query){
                    $query->online();
                },
                'menulinks.translations',
                'menulinks.page.translations',
            ];
            $menus = $this->app->make('TypiCMS\Modules\Menus\Repositories\MenuInterface')->all($with);
            $this->app->instance('TypiCMS.menus', $menus);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

    }
}
