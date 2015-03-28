<?php
namespace App\Modules\Manager\Http\Controllers;

use App\Modules\Manager\Http\Domain\Models\Module;
use App\Modules\Manager\Http\Domain\Repositories\ModuleRepository;

use Illuminate\Http\Request;
use App\Modules\Manager\Http\Requests\ModuleCreateRequest;
use App\Modules\Manager\Http\Requests\ModuleUpdateRequest;
use App\Modules\Manager\Http\Requests\DeleteRequest;

use Datatables;
use Flash;

class MMController extends ManagerController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Modules\Kagi\Http\Domain\Repositories\UserRepository
	 */
	protected $modules;

	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Repositories\ModuleRepository $module
	 * @return void
	 */
	public function __construct(
			ModuleRepository $module
		)
	{
		$this->module = $module;
// middleware
		$this->middleware('auth');
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//dd("loaded");
		return View('manager::modules.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
dd("create");
//		return view('kagi::users.create', $this->user->create());
		return view('manager::modules.create');
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
		return View('manager::modules.show',  $this->module->show($id));
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
		return View('manager::modules.edit',  $this->module->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\requests\UserUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		ModuleUpdateRequest $request,
		$id
		)
	{
//dd($request->enabled);

		$this->module->update($request->all(), $id);
		Flash::success( trans('kotoba::module.success.update') );
		return redirect('manager');
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
		$this->user->destroy($id);

		return redirect('user')->with('ok', trans('back/users.destroyed'));
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Module::select(array('modules.id','modules.name','modules.slug','modules.version','modules.description','modules.enabled','modules.order'))
//			->orderBy('modules.name', 'ASC');
//		$query = Module::select('id', 'name', 'slug', 'version', 'description', 'enabled', 'order')
//			->orderBy('name', 'ASC');
		$query = Module::select('id', 'name', 'slug', 'version', 'description', 'enabled', 'order');
//dd($query);

		return Datatables::of($query)
			->remove_column('id')

			-> edit_column(
				'enabled',
				'@if ($enabled=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
				)

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/manager/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
					<a href="{{ URL::to(\'welcome/\' . $slug . \'/\' ) }}" class="btn btn-info btn-sm" >
						<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
					</a>
				'
				)

			->make(true);
	}


}
