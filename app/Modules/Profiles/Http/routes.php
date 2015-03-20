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

/*
Route::group(['prefix' => 'admin'], function() {
	Route::pattern('id', '[0-9]+');
});
*/
Route::pattern('id', '[0-9]+');

# main controller
Route::resource('profiles', 'ProfilesController');


# API data
Route::get('api/profiles', array(
//	'as'=>'api.users',
	'uses'=>'ProfilesController@data'
	));
