<?php
namespace App\Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;

use App;
use Config;
use Lang;
use LaravelLocalization;
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
		$this->middleware('guest');
	}


	public function setLanguage($lang)
	{
//dd($lang);

		Session::put('locale', $lang);
//		App::setLocale(Session::get('locale'));
//		App::setLocale($lang);
		Lang::setLocale($lang);
		LaravelLocalization::setLocale($lang);

		return Redirect::back();
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
// 		return view('home');
//		return Theme::View('modules.general.dashboard');
	}


}
