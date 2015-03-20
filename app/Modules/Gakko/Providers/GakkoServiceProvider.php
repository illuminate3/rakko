<?php
namespace App\Modules\Gakko\Providers;

use Illuminate\Support\ServiceProvider;

use App;
use Config;
use Lang;
use Menu;
use View;

class GakkoServiceProvider extends ServiceProvider
{
	/**
	 * Register the Gakko module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Gakko\Providers\RouteServiceProvider');

		$this->mergeConfigFrom(
			__DIR__.'/../Config/gakko.php', 'gakko'
		);

		$this->registerNamespaces();
	}

	/**
	 * Register the Gakko module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
//		Lang::addNamespace('gakko', __DIR__.'/../Resources/Lang/');
		View::addNamespace('gakko', __DIR__.'/../Resources/Views/');
	}

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../Config/gakko.php' => config_path('gakko.php'),
		]);
/*
		Menu::make('public', function($menu) {
			$menu->add('Welcome', 'welcome');
			$menu->welcome->add('Employees', 'employees');
			$menu->welcome->add('Departments', 'departments');
			$menu->welcome->add('Grades', 'grades');
			$menu->welcome->add('Divisions', 'divisions');
			$menu->welcome->add('Positions', 'positions');
			$menu->welcome->add('Subjects', 'subjects');
			$menu->welcome->add('Employee Types', 'employee_types');
			$menu->welcome->add('Job Titles', 'job_titles');
			$menu->welcome->add('Statuses', 'statuses');
			$menu->welcome->add('Sites', 'sites');
			$menu->welcome->add('Rooms', 'rooms');
		});
*/
	}


}
