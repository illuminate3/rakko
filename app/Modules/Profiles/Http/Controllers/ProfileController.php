<?php
namespace App\Modules\Profiles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

//abstract class ProfileController extends BaseController {
class ProfileController extends Controller
{

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Initializer.
	 *
	 * @return \AdminController
	 */
	public function __construct()
	{
/*
		parent::__construct();
*/
//		$this->middleware('guest');
		$this->middleware('admin');

	}

	/**
	 * Display Welcome
	 *
	 * @return Response
	 */
	public function welcome()
	{
//dd("loaded");
		return View('profiles::profiles');
	}


}
