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

Route::get('kagi', 'KagiController@index');

// Login a user with GitHub (or any provider).
get('social/login', 'SocialAuthController@login');


Route::group(['prefix' => 'kagi'], function() {
//	Route::get('home', 'KagiController@index');
});

Route::controllers([
	'auth' => 'AuthController',
	'password' => 'PasswordController',
]);
