<?php
namespace App\Modules\General\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\General\Http\Domain\Models\Menu;
use App\Modules\General\Http\Domain\Models\MenuLink;

use View;

// use View;


class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Using class based composers...
//		View::composer('profile', 'App\Http\ViewComposers\ProfileComposer');

		// Using Closure based composers...
		View::composer('_partials.footer', function ($view)
		{

$items = MenuLink::orderBy('position')->get();
$menu  = new MenuLink;
$menu = $menu->getHTML($items);
//dd($menu);


			$view->with('menu', $menu);
		});
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
