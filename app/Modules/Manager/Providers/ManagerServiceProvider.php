<?php
namespace App\Modules\Manager\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ManagerServiceProvider extends ServiceProvider
{
	/**
	 * Register the Kagi module service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		App::register('App\Modules\Manager\Providers\RouteServiceProvider');
		App::register('App\Modules\Manager\Providers\ManagerMenuProvider');

		$this->mergeConfigFrom(
			__DIR__.'/../Config/manager.php', 'manager'
		);

		$this->registerNamespaces();

// Broken .. not sure why yet ...
//		$this->registerConsoleCommands();

	}

	/**
	 * Register the module manager resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
//		Lang::addNamespace('manager', __DIR__.'/../Resources/Lang/');
		View::addNamespace('manager', __DIR__.'/../Resources/Views/');
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../Config/manager.php' => config_path('manager.php'),
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string
	 */
/*
	public function provides()
	{
		return ['manager'];
	}
*/
	/**
	 * Register the package console commands.
	 *
	 * @return void
	 */
/*
	protected function registerConsoleCommands()
	{
		$this->registerInstallCommand();

		$this->commands([
			'manager.install'
		]);
	}
*/

	/**
	 * Register the "module:seed" console command.
	 *
	 * @return Console\ModuleSeedCommand
	 */
/*
	protected function registerInstallCommand()
	{
		$this->app->bindShared('manager.install', function() {
			return new App\Modules\Manager\Console\Commands\ManagerCommand;
		});
	}
*/

}
