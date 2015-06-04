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
// 		View::composer('_partials.menu_links', 'App\Modules\General\Http\ViewComposers\HeaderComposer');
// 		View::composer('_partials.footer', 'App\Modules\General\Http\ViewComposers\FooterComposer');

		// Using Closure based composers...
// 		View::composer('dashboard', function($view)
// 		{
// 			//
// 		});
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
