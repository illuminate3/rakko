<?php
namespace App\Modules\General\Providers;

use Illuminate\Support\ServiceProvider;

use App;
use Config;
use Lang;
use Menu;
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
		App::register('App\Modules\General\Providers\GeneralMenuProvider');
		App::register('App\Modules\General\Providers\ComposerServiceProvider');

		$this->registerNamespaces();
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

	}


}
