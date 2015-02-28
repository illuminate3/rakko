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
// 		} else {
// 		dd("ready to install");
		}
		Route::get('/','InstallerController@getIndex');
		Route::get('/artisan','InstallerController@getArtisan');
		Route::get('/settings','InstallController@getSettings');
// 		Route::post('/database','InstallController@postDatabase');
// 		Route::post('/timezone','InstallController@postTimeZone');
// 		Route::post('/adminaccount','InstallController@postAdminAccount');
	});
