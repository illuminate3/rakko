<?php
namespace App\Modules\Installer\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class InstallerServiceProvider extends ServiceProvider
{

	/**
	 * Register the Installer module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.

		App::register('App\Modules\Installer\Providers\RouteServiceProvider');
		$this->registerNamespaces();

// 		$this->mergeConfigFrom(
// 			__DIR__.'/../Config/rakko.php', 'rakko'
// 		);

	}

	/**
	 * Register the Installer module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('installer', realpath(__DIR__.'/../Resources/Lang'));
		View::addNamespace('installer', realpath(__DIR__.'/../Resources/Views'));
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{

//dd(base_path() . 'App/Modules/Installer/Config/rakko.php');

		$this->publishes([
			__DIR__.'/../Config/rakko.php' => config_path('rakko.php'),
		]);

		$this->publishes([
			__DIR__.'/../Config/rakko.php' => config_path('rakko.php')
		], 'rakko');

	}


}
