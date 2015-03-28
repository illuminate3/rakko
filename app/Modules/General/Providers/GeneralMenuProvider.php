<?php
namespace App\Modules\General\Providers;

use App\Providers\MenuServiceProvider;

use Auth;
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
		$menu->add('Home', '')->data('order', 1);
// 		$menu->add('School', 'school')->data('order', 2);
// 		$menu->school->add('Employees', 'employees');
// 		$menu->school->add('Sites', 'sites');
		$menu->sortBy('order');

// right side drop down
// 		$menu = Menu::get('admin');
// 		$menu->add('Departments', 'admin/departments');
// 		$menu->add('Divisions', 'admin/divisions');
// 		$menu->add('Employee Types', 'admin/employee_types');
// 		$menu->add('Grades', 'admin/grades');
// 		$menu->add('Job Titles', 'admin/job_titles');
// 		$menu->add('Positions', 'admin/positions');
// 		$menu->add('Statuses', 'admin/statuses');
// 		$menu->add('Subjects', 'admin/subjects');
//		$menu->add('Rooms', 'admin/rooms');

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
