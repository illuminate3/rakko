<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

//abstract class KagiController extends BaseController {
class GakkoController extends Controller
{

	use DispatchesCommands, ValidatesRequests;

	/**
	 * Initializer.
	 *
	 * @return \GakkoController
	 */
	public function __construct()
	{
/*
		parent::__construct();
		$this->middleware('csrf');
		$this->middleware('auth');
*/
// middleware
		$this->middleware('auth');
//		$this->middleware('guest');
//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::school');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function school()
	{
		return View('gakko::school');
	}


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function welcome()
	{
		return View('gakko::gakko');
	}


}
