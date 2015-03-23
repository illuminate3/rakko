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

Route::get('welcome/gakko', array(
	'uses'=>'GakkoController@welcome'
	));

//Route::get('/', Config::get('general.home_controller'));
Route::get('/', 'GakkoController@index');

Route::get('school', array(
	'uses'=>'GakkoController@school'
	));

//Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
Route::group(['prefix' => 'admin'], function() {

	Route::pattern('id', '[0-9]+');

// Admin
// 	Route::get('rooms.destroy', array(
// 	//	'as'=>'rooms.destroy',
// 		'uses'=>'RoomsController@destroy'
// 		));

# Controllers
Route::resource('departments', 'DepartmentsController');
Route::resource('employee_types', 'EmployeeTypesController');
Route::resource('job_titles', 'JobTitlesController');
Route::resource('statuses', 'StatusesController');
//Route::resource('rooms', 'RoomsController');

// API DATA
	Route::get('api/departments', array(
	//	'as'=>'api.departments',
		'uses'=>'DepartmentsController@data'
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
// 	Route::get('api/rooms', array(
// 	//	'as'=>'api.rooms',
// 		'uses'=>'RoomsController@data'
// 		));

});

Route::resource('divisions', 'DivisionsController');
Route::resource('employees', 'EmployeesController');
Route::resource('grades', 'GradesController');
Route::resource('positions', 'PositionsController');
Route::resource('sites', 'SitesController');
Route::resource('subjects', 'SubjectsController');

// API DATA
	Route::get('api/divisions', array(
	//	'as'=>'api.divisions',
		'uses'=>'DivisionsController@data'
		));
	Route::get('api/employees', array(
	//	'as'=>'api.employees',
		'uses'=>'EmployeesController@data'
		));
	Route::get('api/grades', array(
	//	'as'=>'api.grades',
		'uses'=>'GradesController@data'
		));
	Route::get('api/positions', array(
	//	'as'=>'api.positions',
		'uses'=>'PositionsController@data'
		));
	Route::get('api/sites', array(
	//	'as'=>'api.sites',
		'uses'=>'SitesController@data'
		));
	Route::get('api/subjects', array(
	//	'as'=>'api.subjects',
		'uses'=>'SubjectsController@data'
		));
