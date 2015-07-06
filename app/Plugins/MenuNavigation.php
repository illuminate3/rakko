<?php
namespace App\Plugins;

use App\Modules\Himawari\Http\Domain\Models\Content as Content;


use App;
//use Cache;
use Config;
//use DB;
use Menu;
use Session;

class MenuNavigation
{


	public function run()
	{

		Menu::handler('top')->hydrate(function()
			{
//			$pages = Content::where('print_status_id', '=', 3)->orderBy('order')->get();
			$pages = Content::whereRaw('print_status_id = 3 OR print_status_id = 4')->orderBy('order')->get();
//dd($pages);
			return $pages;
			},
			function($children, $item)
			{
				if($item->depth < 1) {
					$children->add($item->slug, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
				}
			});

		return view("plugins.navigation_menu");
	}


}
