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
		App::register('App\Modules\Installer\Providers\RouteServiceProvider');

		$this->registerNamespaces();
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
// config
		$this->publishes([
			__DIR__.'/../Config/rakko.php' => config_path('rakko.php')
		], 'config');

// assets
// views

	}


}
