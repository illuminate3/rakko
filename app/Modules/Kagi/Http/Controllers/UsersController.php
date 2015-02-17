<?php namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Repositories\UserRepository;
use App\Modules\Kagi\Http\Domain\Repositories\RoleRepository;

//use Illuminate\Http\Request;
use App\Modules\Kagi\Http\Requests\UserCreateRequest;
use App\Modules\Kagi\Http\Requests\UserUpdateRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class UsersController extends KagiController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user;

	/**
	 * The RoleRepository instance.
	 *
	 * @var App\Repositories\RoleRepository
	 */
	protected $role;

	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\UserRepository $user
	 * @param  App\Repositories\RoleRepository $role
	 * @return void
	 */
	public function __construct(
			UserRepository $user,
			RoleRepository $role
		)
	{
		$this->user = $user;
		$this->role = $role;

		$this->middleware('admin');
//		$this->middleware('ajax', ['only' => 'updateSeen']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//$users = User::all();
//dd($users);
		return View('kagi::users.index');
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
		return view('kagi::users.create');
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
		return View('kagi::users.show',  $this->user->show($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
//dd("edit");
		return View('kagi::users.edit',  $this->user->edit($id));
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
//dd("update");
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
//dd("loaded");
/*
			<th>{{ trans('kotoba::general.verified') }}</th>
			<th>{{ trans('kotoba::general.banned') }}</th>
			<th>{{ trans('kotoba::general.confirmed') }}</th>
			<th>{{ trans('kotoba::general.activated') }}</th>
*/
		$users = User::select(array('users.id','users.name','users.email','users.verified','users.banned','users.confirmed','users.activated', 'users.created_at'))
			->orderBy('users.email', 'ASC');
//dd($users);

		return Datatables::of($users)

			-> edit_column(
				'verified',
				'@if ($verified=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
				)
			-> edit_column(
				'banned',
				'@if ($banned=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
				)
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
				)
			-> edit_column(
				'activated',
				'@if ($activated=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
				)

			->add_column(
				'actions',
				'<a href="{{ URL::to(\'admin/users/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
					<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
				</a>
				<a href="{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				')
/*				<a href="{{ URL::to(\'admin/users/\' . $id . \'/\' ) }}" class="btn btn-sm btn-danger action_confirm" data-method="delete" title="{{ trans(\'kotoba::general.command.delete\') }}" onclick="">
					<span class="glyphicon glyphicon-trash"></span> {{ trans("kotoba::button.delete") }}
				</a>
*/

				->remove_column('id')

				->make();
	}

}
