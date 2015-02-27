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

Route::get('welcome/shisan', array(
	'uses'=>'ShisanController@welcome'
	));


/*
Route::resource('asset', 'AssetsController');
//Route::when('assets/*', 'AssetsController');
Route::resource('items', 'ItemsController');
Route::resource('rooms', 'RoomsController');
Route::resource('sites', 'SitesController');
Route::resource('divisions', 'DivisionsController');

Route::resource('asset_statuses', 'AssetStatusesController');
Route::resource('tech_statuses', 'TechStatusesController');



Route::get('/', 'CategoryController@show');
Route::get('/', array(
	'as' => 'home',
	'uses' => 'CategoryController@show'
	));


Route::resource('categories', 'CategoriesController', array('except' => array('show')));

Route::group(array('prefix' => 'categories'), function () {

    foreach (array('up', 'down') as $key)
    {
        Route::post("{categories}/$key", array(
            'as' => "categories.$key",
            'uses' => "CategoriesController@$key",
        ));
    }

    Route::get('export', array(
        'as' => 'categories.export',
        'uses' => 'CategoriesController@export',
    ));

    Route::get('{categories}/confirm', array(
        'as' => 'categories.confirm',
        'uses' => 'CategoriesController@confirm',
    ));
});


// The slug route should be registered last since it will capture any slug-like
// route
Route::get('{slug}', array('as' => 'category', 'uses' => 'CategoryController@show'))
    ->where('slug', Category::$slugPattern);


Route::controller('scans', 'ScansController');
Route::get('scans/index',
	[
		'as' => 'scans.index',
		'uses' => 'ScansController@index',
	]
);
Route::get('scans/pallet',
	[
		'as' => 'scans.pallet',
		'uses' => 'ScansController@getPallet',
	]
);
Route::post('scans/pallet',
	[
		'as' => 'scans.pallet',
		'uses' => 'ScansController@postPallet',
	]
);
Route::get('scans/rack',
	[
		'as' => 'scans.rack',
		'uses' => 'ScansController@getRack',
	]
);
Route::post('scans/rack',
	[
		'as' => 'scans.rack',
		'uses' => 'ScansController@postRack',
	]
);
*/


/*
|--------------------------------------------------------------------------
| Chumper Datatables API
|--------------------------------------------------------------------------
*/
/*
Route::get('api/items', array(
	'as'=>'api.items',
	'uses'=>'ItemsController@getDatatable'
	));
Route::get('api/asset', array(
	'as'=>'api.asset',
	'uses'=>'AssetsController@getDatatable'
	));
*/
