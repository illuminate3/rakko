<?php
namespace App\Providers;

use Illuminate\Config\FileLoader;
use Illuminate\Config\LoaderInterface;
use Illuminate\Support\ServiceProvider;

class ConfigWriterServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
/*
	public function register()
	{

		$this->app->bind('app\Helpers\ConfigWriter\Repository', function($app)
		{
			$loader = $this->getConfigLoader();
			$writer = new FileWriter($loader, $app['path.config']);
			return new Repository($loader, $writer, $app['env']);
		});

		$this->app['config'] = $this->app->share(function($app)
		{
			return $app->make('app\Helpers\ConfigWriter\Repository');
		});
	}
*/

	/**
	 * Get the configuration loader instance.
	 *
	 * @return \Illuminate\Config\LoaderInterface
	 */
// 	public function getConfigLoader()
// 	{
// 		return new load(new Filesystem, $this['path'].'/config');
// 	}

/*
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class ConfigWriterProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
// 	public function boot()
// 	{
// 		//
// 	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
/*
	public function register()
	{
		$this->app->bind(
			'App\Helpers\ConfigWriter\ConfigServiceProvider'
		);
	}
*/


}
