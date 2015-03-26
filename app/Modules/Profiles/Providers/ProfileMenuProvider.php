<?php
namespace App\Modules\Profiles\Providers;

use App\Providers\MenuServiceProvider;

use Auth;
use Menu;

class ProfileMenuProvider extends MenuServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

// navbar menu
// 		$menu = Menu::get('navbar');
// 		$menu->add('Profiles', 'profiles')->data('order', 3);
// 		$menu->sortBy('order');

// right side drop down
		$menu = Menu::get('admin');
		$menu->add('Profiles', 'profiles');

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
