<?php
namespace App\Modules\General\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\General\Http\Domain\Models\Menu as LMenu;
// use App\Models\Repositories\MenuRepository;
use App\Modules\General\Http\Domain\Models\MenuLink;
// use App\Models\Repositories\MenuLinkRepository;


use App;
use Cache;
use Config;
use DB;
use Plugin;
use Session;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{


/*
		Menu::handler('admin')->hydrate(function()
			{
			$main_menu_id = LMenu::where('name', '=', 'admin')->pluck('id');
			return MenuLink::where('menu_id', '=', $main_menu_id)->orderBy('position')->get();
			},
			function($children, $item)
			{
				$children->add($item->translate(App::getLocale())->url, $item->translate(App::getLocale())->title, Menu::items($item->as));
			});

		Menu::handler('main')->hydrate(function()
			{
			$main_menu_id = LMenu::where('name', '=', 'main')->pluck('id');
			return MenuLink::where('menu_id', '=', $main_menu_id)->orderBy('position')->get();
			},
			function($children, $item)
			{
				$children->add($item->translate(Config::get('app.locale'))->url, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
			});
*/

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
// Plugin::register('MenuAdmin', 'App\Plugins\MenuAdmin');
// Plugin::register('MenuFooter', 'App\Plugins\MenuFooter');

		Plugin::register('MenuAdmin', 'App\Plugins\MenuAdmin');
		Plugin::register('MenuFooter', 'App\Plugins\MenuFooter');
		Plugin::register('MenuNavigation', 'App\Plugins\MenuNavigation');

	}



}
