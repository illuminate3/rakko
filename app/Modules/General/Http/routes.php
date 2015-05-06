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
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localizationRedirect', 'localeSessionRedirect' ]
],
function()
{

// Route::group(['prefix' => LaravelLocalization::setLocale()], function()
// {
//------- ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP -------//

	Route::get('welcome/general', array(
		'uses'=>'GeneralController@welcome'
		));

// API DATA


//Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::group(['prefix' => 'admin'], function() {

		Route::pattern('id', '[0-9]+');

// Controllers
		Route::resource('statuses', 'StatusesController');

// API DATA
		Route::get('api/statuses', array(
//			'as'=>'api.statuses',
			'uses'=>'StatusesController@data'
			));

	});

});
