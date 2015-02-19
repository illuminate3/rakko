<?php
namespace App\Modules\Profiles\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ProfilesServiceProvider extends ServiceProvider
{
	/**
	 * Register the Profiles module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Profiles\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Profiles module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('Profiles', __DIR__.'/../Resources/Lang/');

		View::addNamespace('Profiles', __DIR__.'/../Resources/Views/');
	}
}
