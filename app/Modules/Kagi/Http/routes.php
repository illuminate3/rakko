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
	'auth' => 'kagiAuthController',
	'password' => 'KagiPasswordController',
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
	Route::resource('users', 'UsersController');
/*
	Route::get('users/', 'UsersController@index');
	Route::get('users/create', 'UsersController@getCreate');
	Route::post('users/create', 'UsersController@postCreate');
	Route::get('users/{id}/edit', 'UsersController@getEdit');
	Route::post('users/{id}/edit', 'UsersController@postEdit');
	Route::get('users/{id}/delete', 'UsersController@getDelete');
	Route::post('users/{id}/delete', 'UsersController@postDelete');
*/

	#Roles
	Route::resource('roles', 'RolesController');
/*
	Route::get('roles/', 'RoleController@index');
	Route::get('roles/create', 'RoleController@getCreate');
	Route::post('roles/create', 'RoleController@postCreate');
	Route::get('roles/{id}/edit', 'RoleController@getEdit');
	Route::post('roles/{id}/edit', 'RoleController@postEdit');
	Route::get('roles/{id}/delete', 'RoleController@getDelete');
	Route::post('roles/{id}/delete', 'RoleController@postDelete');
	Route::get('roles/data', 'RoleController@data');
*/

	Route::resource('permissions', 'PermissionsController');


// API DATA
	Route::get('api/users', array(
	//	'as'=>'api.users',
		'uses'=>'UsersController@data'
		));
	Route::get('api/roles', array(
	//	'as'=>'api.users',
		'uses'=>'RolesController@data'
		));
	Route::get('api/permissions', array(
	//	'as'=>'api.users',
		'uses'=>'PermissionsController@data'
		));


});


/*
|--------------------------------------------------------------------------
| Chumper Datatables API
|--------------------------------------------------------------------------
*/
