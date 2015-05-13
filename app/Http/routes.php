<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
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

// set pattern for locales
	Route::pattern('id', '[0-9]+');

//Route::get('/', 'HomeController@index');
	Route::get('home', 'HomeController@index');
	Route::get('welcome', 'WelcomeController@index');


// Set pattern for admin
	Route::group(['prefix' => 'admin'], function() {
		Route::pattern('id', '[0-9]+');
	});


});
