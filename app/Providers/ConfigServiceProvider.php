<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */
	public function register()
	{
// 		config([
// 			//
// 		]);

		config([
			'laravellocalization.supportedLocales' => [
// 				'en' => [ 'name' => 'English', 'script' => 'Latn', 'native' => 'English' ],
// 				'es' => [ 'name' => 'Spanish', 'script' => 'Latn', 'native' => 'español'],

'ace' => array( 'name' => 'Achinese', 'script' => 'Latn', 'native' => 'Aceh' ),
'ca'  => array( 'name' => 'Catalan', 'script' => 'Latn', 'native' => 'català' ),
'en'  => array( 'name' => 'English', 'script' => 'Latn', 'native' => 'English' ),

			],
			'laravellocalization.useAcceptLanguageHeader' => true,
			'laravellocalization.hideDefaultLocaleInURL' => true
		]);

	}

}
