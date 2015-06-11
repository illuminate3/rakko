<?php
namespace App\Modules\General\Http\Domain\Typi\Traits;

use Illuminate\Support\Facades\File;

trait HtmlCacheEvents {


	/**
	 * Event to delete files in public/html folder
	 *
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();

		if (config('typicms.html_cache')) {

			static::saved(function($model) {
				File::deleteDirectory(public_path() . '/html');
			});

			static::deleted(function($model) {
				File::deleteDirectory(public_path() . '/html');
			});

		}
	}


}
