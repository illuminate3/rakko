<?php

/*
|--------------------------------------------------------------------------
| Profiles
|--------------------------------------------------------------------------
*/


// Resources

Route::resource('profiles', 'ProfilesController');
	Route::delete('profiles/{id}', array(
		'as'=>'profiles.destroy',
		'uses'=>'ProfilesController@destroy'
		));

// Controllers

Route::get('welcome/profiles', array(
	'uses'=>'ProfileController@welcome'
	));

// API DATA
Route::get('api/profiles', array(
//	'as'=>'api.profiles',
	'uses'=>'ProfilesController@data'
	));


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources
// Controllers
// API DATA

});
// --------------------------------------------------------------------------
