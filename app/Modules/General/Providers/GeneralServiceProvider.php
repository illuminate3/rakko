<?php
namespace App\Modules\General\Providers;

use Exception;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Services\Cache\LaravelCache;
use App\Modules\General\Http\Domain\Typi\Menus\CacheDecorator;
use App\Modules\General\Http\Domain\Typi\Menus\EloquentMenu;

use App;
use Config;
use Lang;
use Log;
use View;

class GeneralServiceProvider extends ServiceProvider
{


	/**
	 * Register the General module service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		App::register('App\Modules\General\Providers\RouteServiceProvider');
		App::register('App\Modules\General\Providers\MenuServiceProvider');

		$this->registerNamespaces();
//		$this->registerMenus();

		App::register('App\Modules\General\Providers\RepositoryServiceProvider');
//		App::register('App\Modules\General\Providers\ComposerServiceProvider');

	}


	/**
	 * Register the General module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
//		Lang::addNamespace('general', __DIR__.'/../Resources/Lang/');
		View::addNamespace('general', __DIR__.'/../Resources/Views/');
	}


	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->storeAllMenus();


// config
		$this->publishes([
			__DIR__.'/../Config/general.php' => config_path('general.php')
		], 'config');

// assets
// views
		$this->publishes([
			__DIR__.'/../Resources/Views/' => public_path('/themes/default/views/modules/general/')
		], 'views');


//		require app_path().'/Modules/General/Helpers/Helpers.php';


	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return string[]
	 */
// 	public function provides()
// 	{
// 		return ['menus'];
// 	}



// 	protected function registerMenus()
// 	{
//
// 		$app->bind('App\Modules\General\Http\Domain\Typi\menus\MenuInterface', function (Application $app) {
// 			$repository = new EloquentMenu(new Menu);
// 			if (! config('typicms.cache')) {
// 				return $repository;
// 			}
// 			$laravelCache = new LaravelCache($app['cache'], ['menus', 'menulinks', 'pages'], 10);
//
// 			return new CacheDecorator($repository, $laravelCache);
// 		});
//
// 	}




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
//				'menulinks.page.translations',
			];
			$menus = $this->app->make('App\Modules\General\Http\Domain\Typi\Menus\MenuInterface')->all($with);
//dd($menus);
			$this->app->instance('TypiCMS.menus', $menus);
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}

	}


}
