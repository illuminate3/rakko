<?php

/*
|--------------------------------------------------------------------------
| General
|--------------------------------------------------------------------------
*/


// Resources
// Controllers

Route::get('welcome/general', array(
	'uses'=>'GeneralController@welcome'
	));

Route::get('home', array(
	'uses'=>'GeneralController@index'
	));


Route::get('/', array(
	'uses'=>'DashboardController@index'
	));

// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources

	Route::resource('locales', 'LocalesController');
	Route::resource('menus', 'MenusController');
	Route::resource('menulinks', 'MenuLinksController');
	Route::get('settings/{key}', array(
		'uses'=>'SettingsController@edit'
		));
	Route::resource('settings', 'SettingsController');
	Route::resource('statuses', 'StatusesController');


// Controllers
// API DATA

	Route::get('api/statuses', array(
		'uses'=>'StatusesController@data'
		));

});
// --------------------------------------------------------------------------
