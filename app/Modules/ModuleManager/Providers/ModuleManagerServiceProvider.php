<?php namespace App\Modules\ModuleManager\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ModuleManagerServiceProvider extends ServiceProvider
{
	/**
	 * Register the Kagi module service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		App::register('App\Modules\ModuleManager\Providers\RouteServiceProvider');

		$this->mergeConfigFrom(
			__DIR__.'/../Config/module_manager.php', 'module_manager'
		);

		$this->registerNamespaces();

// Broken .. not sure why yet ...
//		$this->registerConsoleCommands();

	}

	/**
	 * Register the Kagi module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
//		Lang::addNamespace('module_manager', __DIR__.'/../Resources/Lang/');
		View::addNamespace('module_manager', __DIR__.'/../Resources/Views/');
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../Config/module_manager.php' => config_path('module_manager.php'),
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string
	 */
	public function provides()
	{
//		return ['module_manager'];
	}

	/**
	 * Register the package console commands.
	 *
	 * @return void
	 */
	protected function registerConsoleCommands()
	{
// 		$this->registerInstallCommand();
//
// 		$this->commands([
// 			'module_manager.install'
// 		]);
	}

	/**
	 * Register the "module:seed" console command.
	 *
	 * @return Console\ModuleSeedCommand
	 */
	protected function registerInstallCommand()
	{
// 		$this->app->bindShared('module_manager.install', function() {
// 			return new App\Modules\ModuleManager\Console\Commands\ModuleManagerCommand;
// 		});
	}


}
