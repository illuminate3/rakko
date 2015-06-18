<?php
namespace App\Modules\General\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\General\Http\Domain\Models\Menu as LMenu;
// use App\Models\Repositories\MenuRepository;
use App\Modules\General\Http\Domain\Models\MenuLink;
// use App\Models\Repositories\MenuLinkRepository;


use App;
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

// 		Menu::handler('admin')->hydrate(function()
// 			{
// 			$main_menu_id = LMenu::where('name', '=', 'admin')->pluck('id');
// 			return MenuLink::where('menu_id', '=', $main_menu_id)->orderBy('position')->get();
// 			},
// 			function($children, $item)
// 			{
// 				$children->add($item->translate(Config::get('app.locale'))->url, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
// 			});


		Menu::handler('main')->hydrate(function()
			{
			$main_menu_id = LMenu::where('name', '=', 'main')->pluck('id');
			return MenuLink::where('menu_id', '=', $main_menu_id)->orderBy('position')->get();
			},
			function($children, $item)
			{

			$lang = Session::get('locale');
//dd($lang);
//dd(App::getLocale());

// dd(Session::all());
// 			$lang = Session::get('locale');
// dd($lang);

			if ( $lang == null ) {
//				$lang = Config::get('app.locale');
				$lang = App::getLocale();
			}
				$children->add($item->translate($lang)->url, $item->translate($lang)->title, Menu::items($item->as));
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
