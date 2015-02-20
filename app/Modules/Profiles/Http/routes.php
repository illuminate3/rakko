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
/*
Route::group(['prefix' => 'Profiles'], function() {
	Route::get('/', function() {
		dd('This is the Profiles module index page.');
	});
});
*/
	Route::resource('profiles', 'ProfilesController');
