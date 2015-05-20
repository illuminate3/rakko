<?php
namespace App\Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Theme;

//abstract class KagiController extends BaseController {
class GeneralController extends Controller
{

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Initializer.
	 *
	 * @return \GeneralController
	 */
	public function __construct()
	{
/*
		parent::__construct();
		$this->middleware('csrf');
		$this->middleware('auth');
*/
// middleware
//		$this->middleware('auth');
		$this->middleware('guest');
//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Theme::View('modules.general.landing');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function welcome()
	{
		return Theme::View('modules.general.general');
	}


}
