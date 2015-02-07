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
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Kagi\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Kagi module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('kagi', __DIR__.'/../Resources/Lang/');
		View::addNamespace('kagi', __DIR__.'/../Resources/Views/');
	}
}
