<?php
namespace App\Providers;

use Config;
use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$locales = Config::get('languages.supportedLocales');
//dd($locales);

		View::share('locales', $locales);
	}

	public function register()
	{
		//
	}


}
