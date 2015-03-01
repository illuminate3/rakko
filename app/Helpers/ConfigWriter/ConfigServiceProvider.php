<?php
namespace app\Helpers\ConfigWriter;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app->bind('app\Helpers\ConfigWriter\Repository', function($app)
		{
			$loader = $app->getConfigLoader();
			$writer = new FileWriter($loader, $app['path.config']);
			return new Repository($loader, $writer, $app['env']);
		});

		$this->app['config'] = $this->app->share(function($app)
		{
			return $app->make('app\Helpers\ConfigWriter\Repository');
		});
	}


}
