<?php
namespace App\Modules\Kagi\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class KagiServiceProvider extends ServiceProvider
{
	/**
	 * Register the Kagi module service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		App::register('App\Modules\Kagi\Providers\RouteServiceProvider');
//		App::register('App\Modules\Kagi\Providers\KagiMenuProvider');

		$this->mergeConfigFrom(
			__DIR__.'/../Config/kagi.php', 'kagi'
		);
		$this->mergeConfigFrom(
			__DIR__.'/../Config/kagi_services.php', 'kagi_services'
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
//		Lang::addNamespace('kagi', __DIR__.'/../Resources/Lang/');
		View::addNamespace('kagi', __DIR__.'/../Resources/Views/');
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../Config/kagi.php' => config_path('kagi.php'),
		]);
		$this->publishes([
			__DIR__.'/../Config/kagi_services.php' => config_path('kagi_services.php'),
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string
	 */
	public function provides()
	{
//		return ['kagi'];
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
// 			'kagi.install'
// 		]);
	}

	/**
	 * Register the "module:seed" console command.
	 *
	 * @return Console\ModuleSeedCommand
	 */
	protected function registerInstallCommand()
	{
// 		$this->app->bindShared('kagi.install', function() {
// 			return new App\Modules\Kagi\Console\Commands\KagiCommand;
// 		});
	}


}
