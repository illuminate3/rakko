<?php
namespace App\Modules\Shisan\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ShisanServiceProvider extends ServiceProvider
{
	/**
	 * Register the Shisan module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Shisan\Providers\RouteServiceProvider');
		App::register('App\Modules\Shisan\Providers\ShisanMenuProvider');

		$this->mergeConfigFrom(
			__DIR__.'/../Config/shisan.php', 'shisan'
		);

		$this->registerNamespaces();
	}

	/**
	 * Register the Shisan module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
//		Lang::addNamespace('Shisan', realpath(__DIR__.'/../Resources/Lang'));
		View::addNamespace('Shisan', realpath(__DIR__.'/../Resources/Views'));
	}


}
