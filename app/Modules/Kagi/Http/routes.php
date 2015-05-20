<?php


/*
|--------------------------------------------------------------------------
| Kagi
|--------------------------------------------------------------------------
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
/*
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
*/


// Resources


// Controllers

Route::get('welcome/kagi', array(
	'uses'=>'KagiController@welcome'
	));

Route::get('social/login', 'SocialAuthController@login');

Route::controllers([
	'auth' => 'kagiAuthController',
	'password' => 'KagiPasswordController',
]);
Route::group(['prefix' => 'auth'], function() {
	Route::get('confirm/{code}', 'kagiAuthController@getConfirm');
	Route::post('confirm/{code}', 'kagiAuthController@postConfirm');
});

// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources

# Users
	Route::resource('users', 'UsersController');
	Route::get('getDelete/{id}', 'UsersController@getDelete');
# Roles
	Route::resource('roles', 'RolesController');
# Permissions
	Route::resource('permissions', 'PermissionsController');

// Controllers
// API DATA
	Route::get('api/users', array(
	//	'as'=>'api.users',
		'uses'=>'UsersController@data'
		));
	Route::get('api/roles', array(
	//	'as'=>'api.roles',
		'uses'=>'RolesController@data'
		));
	Route::get('api/permissions', array(
	//	'as'=>'api.permissions',
		'uses'=>'PermissionsController@data'
		));

});
// --------------------------------------------------------------------------
