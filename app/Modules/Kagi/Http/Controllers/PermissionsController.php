<?php namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Domain\Models\Permission;
use App\Modules\Kagi\Http\Domain\Repositories\PermissionRepository;

//use Illuminate\Http\Request;
use App\Modules\Kagi\Http\Requests\PermissionCreateRequest;
use App\Modules\Kagi\Http\Requests\PermissionUpdateRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class PermissionsController extends KagiController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Modules\Kagi\Http\Domain\Repositories\PermissionRepository
	 */
	protected $permissions;

	/**
	 * Create a new PermissionsController instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Repositories\PermissionRepository $permission
	 * @return void
	 */
	public function __construct(
			PermissionRepository $permission
		)
	{
		$this->permission = $permission;
// middleware
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//$permissions = User::all();
//dd($permissions);
		return View('kagi::permissions.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
//dd("create");
//		return view('kagi::permissions.create', $this->permission->create());
		return view('kagi::permissions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Modules\Kagi\Http\Requests\PermissionCreateRequest $request
	 *
	 * @return Response
	 */
	public function store(
		PermissionCreateRequest $request
		)
	{
		$this->permission->store($request->all());

		Flash::success( trans('kotoba::permission.success.create') );
//		return redirect('admin/permissions')->with('ok', trans('kotoba.permissions.created'));
		return redirect('admin/permissions');
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
		return View('kagi::permissions.show',  $this->permission->show($id));
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
		return View('kagi::permissions.edit',  $this->permission->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Modules\Kagi\Http\Requests\PermissionUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		PermissionUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->permission->update($request->all(), $id);

		Flash::success( trans('kotoba::permission.success.update') );
//		return redirect('permission')->with('ok', trans('back/permissions.updated'));
		return redirect('admin/permissions');
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
dd("destroy");
		$this->permission->destroy($id);

		return redirect('permission')->with('ok', trans('back/permissions.destroyed'));
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$permissions = Permission::select(array('permissions.id','permissions.name','permissions.slug','permissions.description', 'permissions.created_at'))
			->orderBy('permissions.name', 'ASC');
//dd($permissions);

		return Datatables::of($permissions)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'admin/permissions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
					<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
				</a>
				')
/*
				<a href="{{ URL::to(\'admin/permissions/\' . $id . \'/destroy\' ) }}" class="btn btn-sm btn-danger action_confirm" data-method="delete" title="{{ trans(\'kotoba::general.command.delete\') }}" onclick="">
					<span class="glyphicon glyphicon-trash"></span> {{ trans("kotoba::button.delete") }}
				</a>
*/

				->remove_column('id')

				->make();
	}

}
