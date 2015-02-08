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

// Just a dummy page to demonstrate the authentication (or lack of).
get('/', function()
{
    if (Auth::check()) return 'Welcome back, '  . Auth::user()->username;

    return 'Hi guest. ' . link_to('login', 'Login With Github!');
});

// Login a user with GitHub (or any provider).
get('login', 'SocialAuthController@login');


Route::get('welcome', 'WelcomeController@index');

//Route::get('/', 'HomeController@index');

/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/
