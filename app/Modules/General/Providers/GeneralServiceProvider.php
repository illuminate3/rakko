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
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\General\Providers\RouteServiceProvider');
		App::register('App\Modules\General\Providers\GeneralMenuProvider');

		$this->mergeConfigFrom(
			__DIR__.'/../Config/general.php', 'general'
		);

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
		$this->publishes([
			__DIR__.'/../Config/general.php' => config_path('general.php'),
		]);
	}


}
