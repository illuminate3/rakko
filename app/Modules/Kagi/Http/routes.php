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

// Just a dummy page to demonstrate the authentication (or lack of).
/*
get('/', function()
{
    if (Auth::check()) return 'Welcome back, '  . Auth::user()->username . link_to('auth/logout', 'LOGOUT');

    return 'Hi guest. ' . link_to('login', 'Login With Github!');
});
*/
// Login a user with GitHub (or any provider).
get('login', 'SocialAuthController@login');

Route::get('kagi', 'KagiController@index');

Route::controllers([
	'auth' => 'AuthController',
	'password' => 'PasswordController',
]);


Route::group(['prefix' => 'kagi'], function() {
//	Route::get('home', 'KagiController@index');
});
