<?php
namespace App\Modules\Profiles\Providers;

use Illuminate\Support\ServiceProvider;

use App;
use Config;
use Lang;
use Menu;
use View;

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
		App::register('App\Modules\Profiles\Providers\ProfileEventServiceProvider');
		App::register('App\Modules\Profiles\Providers\ProfileMenuProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Profiles module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
//		Lang::addNamespace('profiles', __DIR__.'/../Resources/Lang/');
		View::addNamespace('profiles', __DIR__.'/../Resources/Views/');
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../Config/profiles.php' => config_path('profiles.php'),
		]);

		Menu::make('public', function($menu) {
			$menu->add('Profiles', 'profiles');
		});

	}


}
