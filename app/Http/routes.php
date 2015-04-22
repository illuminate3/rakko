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

$languages = LaravelLocalization::getSupportedLocales();
foreach($languages as $language => $values) {
    $supportedLocales[] = $language;
}

$locale = Request::segment(1);
if(in_array($locale, $supportedLocales)) {
    LaravelLocalization::setLocale($locale);
    App::setLocale($locale);
}

Route::get('/', function () {

    return Redirect::to(LaravelLocalization::getCurrentLocale(), 302);
});

Route::group(array('prefix' => LaravelLocalization::getCurrentLocale(), 'before' => array('localization', 'before')), function () {

    Session::put('my.locale', LaravelLocalization::getCurrentLocale());


//Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('welcome', 'WelcomeController@index');

});
