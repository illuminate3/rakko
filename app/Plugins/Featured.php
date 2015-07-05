<?php
namespace App\Plugins;

use App\Modules\Himawari\Http\Domain\Models\Content as Content;

use App;
use Config;
use Menu;
use Session;


class Featured
{


	public function run()
	{

		Menu::handler('featured')->hydrate(function()
			{
			$pages = Content::where('print_status_id', '=', 2)->IsFeatured()->orderBy('order')->get();
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
