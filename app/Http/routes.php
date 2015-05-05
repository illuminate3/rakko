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

// App::setLocale('en');
// Session::put('locale', 'en');

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


	Route::pattern('id', '[0-9]+');




//Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('welcome', 'WelcomeController@index');



// Route::group(['prefix' => 'admin'], function() {
//
// 	Route::pattern('id', '[0-9]+');
//
// });



});


// 	Route::pattern('id', '[0-9]+');
