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

//Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
Route::group(['prefix' => 'admin'], function() {

	Route::pattern('id', '[0-9]+');

# main controller
	Route::resource('manager', 'MMController');

// API DATA
	Route::get('api/manager', array(
	//	'as'=>'api.manager',
		'uses'=>'MMController@data'
		));

});
