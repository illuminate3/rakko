<?php
namespace App\Modules\Profiles\Http\Controllers;

use App\Modules\Profiles\Http\Domain\Models\Profile;
use App\Modules\Profiles\Http\Domain\Repositories\ProfileRepository;
use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Repositories\UserRepository;

use Illuminate\Http\Request;
use App\Modules\Profile\Http\Requests\ProfileCreateRequest;
use App\Modules\Profile\Http\Requests\ProfileUpdateRequest;
use App\Modules\Profile\Http\Requests\DeleteRequest;

use Auth;
//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class ProfilesController extends ProfileController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Modules\Kagi\Http\Domain\Repositories\UserRepository
	 */
	protected $user;

	/**
	 * The RoleRepository instance.
	 *
	 * @var App\Modules\Profiles\Http\Domain\Repositories\ProfileRepository
	 */
	protected $profile;

	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Repositories\UserRepository $user
	 * @param  App\Modules\Profiles\Http\Domain\Repositories\ProfileRepository $profile
	 * @return void
	 */
	public function __construct(
			UserRepository $user,
			ProfileRepository $profile
		)
	{
		$this->user = $user;
		$this->profile = $profile;

		$this->middleware('admin', ['only' => 'destroy']);
//		$this->middleware('ajax', ['only' => 'updateSeen']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//dd("loaded");
		return View('profiles::profiles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//dd("create");
//		return view('kagi::users.create', $this->user->create());
		return view('profiles::profiles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\requests\UserCreateRequest $request
	 *
	 * @return Response
	 */
	public function store(
		UserCreateRequest $request
		)
	{
dd("store");
		$this->user->store($request->all());

		return redirect('user')->with('ok', trans('back/users.created'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
//dd("show");
		return View('profiles::profiles.show',  $this->profile->show($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
//dd($id);
//dd(Auth::id());
		if (Auth::id() == $id) {
			return View('profiles::profiles.edit',  $this->profile->edit($id));
		} else {
			return View('profiles::profiles.index');
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\requests\UserUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		UserUpdateRequest $request,
		$id
		)
	{
//dd($request->password);
		$this->user->update($request->all(), $id);
		Flash::success( trans('kotoba::account.success.update') );
		return redirect('admin/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(
		DeleteRequest $request,
		$id
		)
	{
		$this->user->destroy($id);
//		$this->user->destroy($id);

		return redirect('user')->with('ok', trans('back/users.destroyed'));
	}

	/**
	 * Display the roles form
	 *
	 * @return Response
	 */
	public function getRoles()
	{
		$roles = $this->role->all();

		return view('back.users.roles', compact('roles'));
	}

	/**
	 * Update roles
	 *
	 * @param  App\requests\RoleRequest $request
	 * @return Response
	 */
	public function postRoles(RoleRequest $request)
	{
		$this->role->update($request->except('_token'));

		return redirect('user/roles')->with('ok', trans('back/roles.ok'));
	}

	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
$users = User::select('name', 'email', 'created_at');
//dd($users);
return Datatables::of($users)
	->addColumn('action', 'action here')
	->make(true);

/*
//dd("loaded");
		$profiles = Profile::select(array('profiles.id','profiles.first_name','profiles.last_name','profiles.email_1','profiles.email_2'))
			->orderBy('profiles.last_name', 'ASC');
//dd($profiles);

		return Datatables::of($profiles)

			->add_column(
				'actions',
				'<a href="{{ URL::to(\'profiles/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
					<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
				</a>
				<a href="{{ URL::to(\'profiles/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				')

				->remove_column('id')

				->make();
*/
	}

}
