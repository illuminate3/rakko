<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\General\Http\Domain\Models\Locale;

use Config;
use View;


class ViewComposerServiceProvider extends ServiceProvider
{


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{

		$locales = $this->getLocales();
//		$locales = Config::get('languages.supportedLocales');
//dd($locales);

		View::share('locales', $locales);
	}

	public function register()
	{
		//
	}


	public function getLocales()
	{

 		$locales = Locale::all();

		if ( empty($locales) ) {
			throw new LocalesNotDefinedException('Please make sure you have run "php artisan config:publish dimsav/laravel-translatable" ' . ' and that the locales configuration is defined.');
		}

	return $locales;
	}


}
