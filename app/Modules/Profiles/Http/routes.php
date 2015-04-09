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

Route::get('welcome/profiles', array(
	'uses'=>'ProfileController@welcome'
	));

Route::pattern('id', '[0-9]+');

# main controller
Route::resource('profiles', 'ProfilesController');
	Route::delete('profiles/{id}', array(
		'as'=>'profiles.destroy',
		'uses'=>'ProfilesController@destroy'
		));


# API data
Route::get('api/profiles', array(
//	'as'=>'api.profiles',
	'uses'=>'ProfilesController@data'
	));

Route::group(['prefix' => 'admin'], function() {
	Route::pattern('id', '[0-9]+');

// Admin
// 	Route::get('profiles.destroy', array(
// 	//	'as'=>'profiles.destroy',
// 		'uses'=>'ProfilesController@destroy'
// 		));
//	Route::get('getDelete/{id}', 'ProfilesController@getDelete');

});
