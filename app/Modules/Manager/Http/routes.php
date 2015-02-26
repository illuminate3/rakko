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

Route::get('welcome/manager', array(
	'uses'=>'ManagerController@welcome'
	));

/*
Route::group(['prefix' => 'Manager'], function() {
	Route::get('/', function() {
		dd('This is the Manager module index page.');
	});
});
*/

Route::resource('manager', 'MMController');


# API data
	Route::get('api/manager', array(
		'uses'=>'MMController@data'
		));
