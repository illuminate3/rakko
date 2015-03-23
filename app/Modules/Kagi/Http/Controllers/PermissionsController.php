<?php
namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Domain\Models\Permission;
use App\Modules\Kagi\Http\Domain\Repositories\PermissionRepository;

//use Illuminate\Http\Request;
use App\Modules\Kagi\Http\Requests\PermissionCreateRequest;
use App\Modules\Kagi\Http\Requests\PermissionUpdateRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

use Datatables;
use DB;
use Flash;
use Form;

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
		return View('kagi::permissions.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Permission::select(array('permissions.id','permissions.name','permissions.slug','permissions.description','permissions.updated_at'))
//			->orderBy('permissions.name', 'ASC');
//		$query = Permission::select('id', 'name', 'slug', 'description', 'updated_at')
//			->orderBy('name', 'ASC');
		$query = Permission::select('id', 'name', 'slug', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/permissions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
