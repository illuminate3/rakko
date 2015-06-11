<?php
namespace App\Modules\General\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Domain\Typi\Menus\CacheDecorator;
use App\Modules\General\Http\Domain\Typi\Menus\EloquentMenu;
use App\Modules\General\Http\Services\Cache\LaravelCache;

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
//		App::register('App\Modules\General\Providers\GeneralMenuProvider');
		App::register('App\Modules\General\Providers\ComposerServiceProvider');
		App::register('App\Modules\General\Providers\RepositoryServiceProvider');
//		App::register('App\Modules\General\Helpers\Helpers.php');

		$this->registerNamespaces();
//		$this->registerMenus();
// App::bind('App\Modules\General\Http\Domain\Typi\Facades\TypiFacade', 'Linker');
// App::bind('App\Modules\General\Http\Domain\Typi\Menus\LinkerInterface', 'Linker');
// $app = $this->app;
// $app->bind('App\Modules\General\Http\Domain\Typi\Menus\MenuInterface', function (Application $app) {});

// AliasLoader::getInstance()->alias(
// 	'Menus',
// 	'TypiCMS\Modules\Menus\Facades\Facade'
// );

$app = $this->app;
$app['typicms'] = $this->app->share(function ($app) {
	return new TypiCMS;
});

AliasLoader::getInstance()->alias(
	'Menus',
			'App\Modules\General\Http\Domain\Typi\Facades\TypiFacade'
//			'App\Modules\General\Http\Domain\Typi\Menus\MenuInterface'
);
//'Linker'				=> 'App\Modules\General\Http\Domain\Typi\Menus\LinkerInterface',
//'Linker'				=> 'App\Modules\General\Http\Domain\Typi\Facades\TypiFacade',
// $this->app->bind(
// 	'App\Modules\General\Http\Domain\Typi\Facades\TypiFacade'
// );

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

//		require app_path().'/Modules/General/Http/composers.php';

//		include __DIR__.'/../Helpers/Helpers.php';
		require app_path().'/Modules/General/Helpers/Helpers.php';

//App::bind('App\Modules\General\Http\Domain\Typi\Menus\MenuInterface', 'Menus');
// $loader = \Illuminate\Foundation\AliasLoader::getInstance();
// $loader->alias('Menus', 'App\Modules\General\Http\Domain\Typi\Menus\MenuInterface');


// 		AliasLoader::getInstance()->alias(
// 			'Linker',
// 			'App\Modules\General\Http\Domain\Typi\Facades\TypiFacade'
// 		);

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



	protected function registerMenus()
	{

		$app->bind('App\Modules\General\Http\Domain\Typi\menus\MenuInterface', function (Application $app) {
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
			$menus = $this->app->make('App\Modules\General\Http\Domain\Typi\Menus\MenuInterface')->all($with);
			$this->app->instance('TypiCMS.menus', $menus);
		} catch (Exception $e) {
			Log::error($e->getMessage());
		}

	}


}
