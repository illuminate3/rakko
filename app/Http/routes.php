<?php

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
/*
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
*/


// set pattern for overall
Route::pattern('id', '[0-9]+');




/*
|--------------------------------------------------------------------------
| Module: General
|--------------------------------------------------------------------------
*/


// Route::group(
// [
// 	'prefix' => LaravelLocalization::setLocale(),
// //	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
// 	'middleware' => [ 'localeSessionRedirect' ]
// ],
// function()
// {
// --------------------------------------------------------------------------

// set pattern for locales
// 	Route::pattern('id', '[0-9]+');

// Resources
// Controllers

//Route::get('/', 'HomeController@index');
// 	Route::get('home', 'HomeController@index');
	Route::get('welcome', 'WelcomeController@index');

// API DATA


// Set pattern for admin
	Route::group(['prefix' => 'admin'], function() {

		Route::pattern('id', '[0-9]+');

// Admin Resources
// Admin Controllers
// Admin API DATA

	});


// --------------------------------------------------------------------------
// });
