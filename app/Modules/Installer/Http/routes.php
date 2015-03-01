<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(
	[
	'prefix'=>'install',
	'before'=>'install'
	],
	function()
	{
		if ( Config::get('rakko.install') ) {
			Flash::warning(trans('installer::install.error.installed'));
			return redirect('/');
		}

		Route::get('/','InstallerController@getIndex');
		Route::get('/artisan','InstallerController@getArtisan');
		Route::get('/settings','InstallerController@getSettings');
		Route::post('/settings','InstallerController@postSettings');

	});
