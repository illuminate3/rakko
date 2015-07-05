<?php
namespace App\Plugins;

use App\Modules\Himawari\Http\Domain\Models\Content as Content;


use App;
//use Cache;
use Config;
//use DB;
use Menu;
use Session;

class Featured
{


	public function run()
	{

		Menu::handler('featured')->hydrate(function()
			{
			$pages = Content::whereRaw('print_status_id = 2 and is_featured =1')->orderBy('order')->get();
//dd($pages);
			return $pages;
			},
			function($children, $item)
			{
				if($item->depth < 1) {
					$children->add($item->slug, $item->translate(Config::get('app.locale'))->title, Menu::items($item->as));
				}
			});

		return view("plugins.featured");
	}


}
