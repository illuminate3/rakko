<?php
namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Domain\Models\Permission;
use App\Modules\Kagi\Http\Domain\Repositories\PermissionRepository;

//use Illuminate\Http\Request;
use App\Modules\Kagi\Http\Requests\PermissionCreateRequest;
use App\Modules\Kagi\Http\Requests\PermissionUpdateRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

use Datatable;
use DB;
use Form;

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

	/**
	 * @return mixed
	 */
	public function getDatatable()
	{
//dd('loaded');

/*
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
*/

//		$query = DB::table('permissions')->remember(10);
		$query = DB::table('permissions');
//dd($query);

		return Datatable::query($query)
			->showColumns('id', 'name', 'slug', 'description', 'created_at')
//			->showColumns('id', 'name')

/*
			->addColumn('actions',

				function($model) {

				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("admin.permissions.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('lingos::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('lingos::account.ask.delete') . '</h4>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('lingos::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('lingos::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
				return
					'<a href="/admin.permissions/' . $model->id . '" class="btn btn-primary form-group" title="' . trans('lingos::general.view') . '"><i class="fa fa-chevron-right fa-fw"></i>' . trans('lingos::button.view') . '</a>&nbsp;'
					. '<a href="/admin.permissions/' . $model->id . '/edit" class="btn btn-success form-group" title="' . trans('lingos::account.command.edit') . '"><i class="fa fa-edit fa-fw"></i>' . trans('lingos::button.edit') . '</a>&nbsp;'
					. Form::button('<span class="glyphicon glyphicon-trash"></span> ' . trans('lingos::button.delete'), array('name'=>'deleteRecord', 'class' => 'btn btn-danger', 'type' => 'button',  'data-toggle' => 'modal', 'data-target' => '#delete-Record-'.$model->id))
					. $modal;
				})

			->searchColumns('name')
			->orderColumns('id', 'name')
*/
			->searchColumns('name', 'slug', 'description')
			->orderColumns('id', 'name', 'slug', 'description', 'created_at')

			->make();
	}



}
