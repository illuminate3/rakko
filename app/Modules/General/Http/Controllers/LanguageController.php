<?php
namespace App\Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;

use App;
use Config;
use Lang;
use Redirect;
use Session;

class LanguageController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
//		$this->middleware('auth');
//		$this->middleware('guest');
	}


	public function setLanguage($lang)
	{
//dd($lang);
//		App::setLocale(Session::get('locale'));
//		$this->app->setLocale($lang);

		Session::forget('locale');

		Session::put('locale', $lang);
		App::setLocale($lang);
//		Lang::setLocale($lang);

		return Redirect::back();
//dd('die');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


}
