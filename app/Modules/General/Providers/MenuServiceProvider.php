<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Menu as LMenu;
// use App\Models\Repositories\MenuRepository;
use App\Models\MenuLink;
// use App\Models\Repositories\MenuLinkRepository;


use Auth;
use Cache;
use Config;
use DB;
use Menu;
use Session;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

//		$lang = Session::get('locale');
//dd($main_menu_id);
//		if ( DB::table('menus')->exists() ) {

		Menu::handler('main')->hydrate(function()
			{
// 			$main_menu = LMenu::where('name', '=', 'main')->get();
// 			$main_menu_id = $main_menu[0]['id'];
//dd($main_menu);
			$main_menu_id = LMenu::where('name', '=', 'main')->pluck('id');
			return MenuLink::where('menu_id', '=', $main_menu_id)->orderBy('position')->get();
//			return MenuLink::where('menu_id', '=', $main_menu_id)->where('status', '=', 1, 'AND')->orderBy('position')->get();
			},
			function($children, $item)
			{
				$children->add($item->translate(Config::get('app.locale'))->url, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
			});

//		}
/*
// navbar menu
		Menu::make('navbar', function($menu) {
			//
		});

// right side drop down
		Menu::make('admin', function($menu) {
			//
		});
*/

/*
	Menu::handler('main')->hydrate(function() {
		$cache = Cache::remember('category.menu',Config::get('cache.stores.file.time'), function() {
			return App\Model\Category::where('active','=',1)->get();
		});
		return $cache;
	},

	function($children, $item) {
		if ($item->hasChildren()) {
//			$children->addClass('has-children');
			$children->add('/page/'.$item->slug, $item->name, Menu::items($item->as));

		} else {
			 $children->add('/page/'.$item->slug, $item->name, Menu::items($item->as));
		}
	}
	);
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
	}



}
