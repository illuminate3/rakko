<?php
namespace App\Plugins;

use App\Modules\General\Http\Domain\Models\Menu as LMenu;
use App\Modules\General\Http\Domain\Models\MenuLink;


use App;
//use Cache;
use Config;
//use DB;
use Menu;
use Session;

class MenuAdmin
{


	public function run()
	{

		Menu::handler('admin')->hydrate(function()
			{
			$main_menu_id = LMenu::where('name', '=', 'admin')->pluck('id');
			return MenuLink::where('menu_id', '=', $main_menu_id)->orderBy('position')->get();
			},
			function($children, $item)
			{
				$children->add($item->translate(App::getLocale())->url, $item->translate(App::getLocale())->title, Menu::items($item->as));
			});

		return view("plugins.admin_menu");
	}


}
