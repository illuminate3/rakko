<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Auth;
use Menu;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Menu::make('public', function($menu) {
			$menu->add('Profiles', 'profiles');
/*
			$menu->add('Module Manager', 'admin/manager');
			$menu->add('View Profile', 'profiles/'.Auth::user()->id);
			$menu->add('view profile', 'profiles'. Auth::user()->id );
*/
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
//
	}



}
