<?php

/*
|--------------------------------------------------------------------------
| General
|--------------------------------------------------------------------------
*/


// Resources
// Controllers

Route::get('welcome/general', array(
	'uses'=>'GeneralController@welcome'
	));


Route::get('/', array(
	'uses'=>'DashboardController@index'
	));

// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources

	Route::resource('statuses', 'StatusesController');
	Route::resource('menus', 'MenusController');
	Route::resource('menulinks', 'MenuLinksController');
	Route::get('menulinks/{id}/new_link', [
//		'as' => 'builds.group',
		'uses' => 'MenuLinksController@create',
		]);
	Route::post('menulinks/save', [
		'as' => 'admin.menulinks.save',
		'uses' => 'MenuLinksController@save'
		]);

	Route::post('menulinks/{id}/delete', [
		'as' => 'admin.menulinks.delete',
		'uses' => 'MenuLinksController@confirmDestroy'
		]);
	Route::post('menulinks/{id}/toggle-publish', [
		'as' => 'admin.menulinks.toggle-publish',
		'uses' => 'MenuLinksController@togglePublish'
		]);


// Controllers
// API DATA

	Route::get('api/statuses', array(
		'uses'=>'StatusesController@data'
		));

});
// --------------------------------------------------------------------------
