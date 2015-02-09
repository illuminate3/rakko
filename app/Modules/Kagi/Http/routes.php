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
/*
Route::group(['prefix' => 'kagi'], function() {
//	Route::get('home', 'KagiController@index');
});
*/

// Login a user with GitHub (or any provider).
get('social/login', 'SocialAuthController@login');

Route::controllers([
	'auth' => 'AuthController',
	'password' => 'PasswordController',
]);

//Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
Route::group(['prefix' => 'admin'], function() {
	Route::pattern('id', '[0-9]+');
	Route::pattern('id2', '[0-9]+');

	#Users
/*
	Route::resource('users', 'UsersController',
		[
//			'before' => 'csrf'
//			'except' => array('show')
		]);
*/
//	Route::resource('users', 'UsersController');
	Route::get('users/', 'UsersController@index');
	Route::get('users/create', 'UsersController@getCreate');
	Route::post('users/create', 'UsersController@postCreate');
	Route::get('users/{id}/edit', 'UsersController@getEdit');
	Route::post('users/{id}/edit', 'UsersController@postEdit');
	Route::get('users/{id}/delete', 'UsersController@getDelete');
	Route::post('users/{id}/delete', 'UsersController@postDelete');
	Route::get('users/data', 'UsersController@data');

	#Roles
//	Route::resource('roles', 'RolessController');
	Route::get('roles/', 'RoleController@index');
	Route::get('roles/create', 'RoleController@getCreate');
	Route::post('roles/create', 'RoleController@postCreate');
	Route::get('roles/{id}/edit', 'RoleController@getEdit');
	Route::post('roles/{id}/edit', 'RoleController@postEdit');
	Route::get('roles/{id}/delete', 'RoleController@getDelete');
	Route::post('roles/{id}/delete', 'RoleController@postDelete');
	Route::get('roles/data', 'RoleController@data');

});


/*
|--------------------------------------------------------------------------
| Chumper Datatables API
|--------------------------------------------------------------------------
*/
Route::get('api/users', array(
	'as'=>'api.users',
	'uses'=>'UsersController@getDatatable'
	));
