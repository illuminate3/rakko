<?php namespace App\Modules\Kagi\Http\Controllers;

use App\Http\Controllers\Controller;

class KagiController extends Controller {

	/**
	 * Initializer.
	 *
	 * @return \AdminController
	 */
	public function __construct()
	{
/*
		parent::__construct();
		$this->middleware('csrf');
		$this->middleware('auth');
		$this->middleware('admin');
*/
		$this->middleware('guest');

	}


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
//dd("loaded");
		return View('kagi::kagi');
	}


}
