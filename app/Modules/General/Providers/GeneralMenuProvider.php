<?php
namespace App\Modules\General\Providers;

use App\Providers\MenuServiceProvider;

use Auth;
use Config;
use Lang;
use Menu;

class GeneralMenuProvider extends MenuServiceProvider {


	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

// navbar menu
		$menu = Menu::get('navbar');
		$menu->add(trans('kotoba::general.home'), '')->data('order', 1);
		$menu->sortBy('order');

// right side drop down
		$menu = Menu::get('admin');
		$menu->add(Lang::choice('kotoba::general.status', 2), 'admin/statuses');
//		$menu->add(Lang::choice('kotoba::hr.employee', 2), 'admin/statuses');

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
