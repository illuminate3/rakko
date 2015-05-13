<?php
namespace App\Modules\General\Http\Controllers;

use App\Modules\Kagi\Http\Domain\Models\User;
// use App\Modules\General\Http\Domain\Models\Status;
// use App\Modules\General\Http\Domain\Repositories\StatusRepository;

// use Illuminate\Http\Request;
// use App\Modules\General\Http\Requests\DeleteRequest;
// use App\Modules\General\Http\Requests\StatusCreateRequest;
// use App\Modules\General\Http\Requests\StatusUpdateRequest;

use Auth;
// use Flash;

class DashboardController extends GeneralController {


	public function __construct(
			User $user
// 			RoleRepository $role
		)
	{
		$this->user = $user;
// 		$this->role = $role;

// middleware
		$this->middleware('guest');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//dd(Auth::user());

		if ( Auth::user() ) {
			if ( Auth::user()->can('manage_admin') ) {
				return View('general::dashboard');
			}
		}
		return View('general::landing');

	}


}
