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

	Route::resource('statuses', 'StatusesController');

// Controllers
// API DATA

	Route::get('api/statuses', array(
		'uses'=>'StatusesController@data'
		));

});
// --------------------------------------------------------------------------
