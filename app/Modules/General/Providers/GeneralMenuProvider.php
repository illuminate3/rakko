<?php
namespace App\Modules\General\Providers;

use App\Providers\MenuServiceProvider;

use Auth;
use LaravelLocalization;
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
		$menu->add(trans('kotoba::general.home'), LaravelLocalization::getCurrentLocale())->data('order', 1);
// 		$menu->add('School', 'school')->data('order', 2);
// 		$menu->school->add('Employees', 'employees');
// 		$menu->school->add('Sites', 'sites');
		$menu->sortBy('order');

// right side drop down
		$menu = Menu::get('admin');
		$menu->add('Statuses', LaravelLocalization::getCurrentLocale() . '/admin/statuses');

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
