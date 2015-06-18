<?php
namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

use App\Modules\General\Http\Domain\Models\Menu as LMenu;
use App\Modules\General\Http\Domain\Models\MenuLink;


//use Auth;
//use Cache;
use Config;
//use DB;
use Menu;
use Session;


class AdminMenu extends AbstractWidget
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
				$children->add($item->translate(Config::get('app.locale'))->url, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
			});

		return view("widgets.admin_menu");
	}


}
