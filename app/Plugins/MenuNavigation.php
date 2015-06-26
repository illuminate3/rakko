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
			$pages = Content::get();
//dd($pages);
			return $pages;
			},
			function($children, $item)
			{
				if($item->depth < 1) {
					$children->add($item->translate(Config::get('app.locale'))->slug, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
				}
			});

		return view("plugins.navigation_menu");
	}


}
