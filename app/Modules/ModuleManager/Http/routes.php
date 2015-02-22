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

	Route::get('module_manager/welcome', array(
		'uses'=>'MMController@welcome'
		));

/*
Route::group(['prefix' => 'ModuleManager'], function() {
	Route::get('/', function() {
		dd('This is the ModuleManager module index page.');
	});
});
*/

Route::resource('module_manager', 'MMController');


# API data
	Route::get('api/module_manager', array(
		'uses'=>'MMController@data'
		));
