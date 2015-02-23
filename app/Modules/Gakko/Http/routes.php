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

Route::get('welcome/gakko', 'GakkoController@welcome');

/*
Route::group(array(
//	'prefix' => Config::get('vedette::vedette_settings.prefix_auth')),
	'prefix' => 'admin',
	'before' => 'auth'),
	function()
{
	Route::resource('departments', 'HR\controllers\DepartmentsController');
	Route::resource('grades', 'HR\controllers\GradesController');
	Route::resource('divisions', 'HR\controllers\DivisionsController');
	Route::resource('positions', 'HR\controllers\PositionsController');
	Route::resource('subjects', 'HR\controllers\SubjectsController');
	Route::resource('employee_types', 'HR\controllers\EmployeeTypesController');
	Route::resource('job_titles', 'HR\controllers\JobTitlesController');
	Route::resource('statuses', 'HR\controllers\StatusesController');
});
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
/*
Route::group(array(
//	'prefix' => Config::get('vedette::vedette_settings.prefix_auth')),
//	'prefix' => 'admin',
	'before' => 'auth'),
	function()
{
	Route::resource('profiles', 'HR\controllers\ProfilesController');
	Route::resource('sites', 'HR\controllers\SitesController');
});
*/

/*
|--------------------------------------------------------------------------
| Chumper Datatables API
|--------------------------------------------------------------------------
*/
// API DATA
	Route::get('api/departments', array(
	//	'as'=>'api.departments',
		'uses'=>'departments@data'
		));
	Route::get('api/grades', array(
	//	'as'=>'api.grades',
		'uses'=>'GradesController@data'
		));
	Route::get('api/divisions', array(
	//	'as'=>'api.divisions',
		'uses'=>'DivisionsController@data'
		));
	Route::get('api/positions', array(
	//	'as'=>'api.positions',
		'uses'=>'PositionsController@data'
		));
	Route::get('api/subjects', array(
	//	'as'=>'api.subjects',
		'uses'=>'SubjectsController@data'
		));
	Route::get('api/employee_types', array(
	//	'as'=>'api.employee_types',
		'uses'=>'EmployeeTypesController@data'
		));
	Route::get('api/job_titles', array(
	//	'as'=>'api.job_titles',
		'uses'=>'JobTitlesController@data'
		));
	Route::get('api/statuses', array(
	//	'as'=>'api.statuses',
		'uses'=>'StatusesController@data'
		));

/*
Route::get('api/sites', array(
	'as'=>'api.sites',
	'uses'=>'HR\controllers\SitesController@getDatatable'
	));

Route::get('api/profiles', array(
	'as'=>'api.profiles',
	'uses'=>'HR\controllers\ProfilesController@getDatatable'
	));
*/
