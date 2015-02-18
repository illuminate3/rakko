<?php namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Domain\Models\Role;
use App\Modules\Kagi\Http\Domain\Repositories\RoleRepository;

use Illuminate\Http\Request;
use App\Modules\Kagi\Http\Requests\RoleCreateRequest;
use App\Modules\Kagi\Http\Requests\RoleUpdateRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class RolesController extends KagiController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $role;

	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Repositories\RoleRepository $role
	 * @return void
	 */
	public function __construct(
			RoleRepository $role
		)
	{
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
//$roles = User::all();
//dd($roles);
		return View('kagi::roles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//dd("create");
//		return view('kagi::roles.create', $this->role->create());
		return view('kagi::roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\requests\UserCreateRequest $request
	 *
	 * @return Response
	 */
	public function store(
		RoleCreateRequest $request
		)
	{
		$this->role->store($request->all());
		Flash::success( trans('kotoba::role.success.create') );
		return redirect('admin/roles');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
dd("show");
		return View('kagi::roles.show',  $this->role->show($id));
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
//		$role = $this->role->edit($id);

		return View('kagi::roles.edit',  $this->role->edit($id));
//		return view('kagi::roles.edit', compact('role'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Modules\Kagi\Http\Requests\RoleUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		RoleUpdateRequest $request,
		$id
		)
	{
//dd($request);
		$this->role->update($request->all(), $id);

		Flash::success( trans('kotoba::role.success.update') );
		return redirect('admin/roles');
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
		$this->role->destroy($id);

		return redirect('role')->with('ok', trans('back/roles.destroyed'));
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$roles = Role::select(array('roles.id','roles.name','roles.slug','roles.description', 'roles.created_at'))
			->orderBy('roles.name', 'ASC');
//dd($roles);

		return Datatables::of($roles)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'admin/roles/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				')
/*
				<a href="{{ URL::to(\'admin/roles/\' . $id . \'/destroy\' ) }}" class="btn btn-sm btn-danger action_confirm" data-method="delete" title="{{ trans(\'kotoba::general.command.delete\') }}" onclick="">
					<span class="glyphicon glyphicon-trash"></span> {{ trans("kotoba::button.delete") }}
				</a>
*/

				->remove_column('id')

				->make();
	}

}
