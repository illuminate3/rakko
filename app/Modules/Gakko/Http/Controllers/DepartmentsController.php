<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Department;
use App\Modules\Gakko\Http\Domain\Repositories\DepartmentRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\DepartmentCreateRequest;
use App\Modules\Gakko\Http\Requests\DepartmentUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class DepartmentsController extends GakkoController {

	/**
	 * Department Repository
	 *
	 * @var Department
	 */
	protected $department;

	public function __construct(
			DepartmentRepository $department
		)
	{
		$this->department = $department;

		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::departments.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::departments.create',  $this->department->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		DepartmentCreateRequest $request
		)
	{
		$this->department->store($request->all());

		Flash::success( trans('kotoba::hr.success.department_create') );
		return redirect('admin/departments');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$department = $this->department->findOrFail($id);
//
// 		return View::make('HR::departments.show', compact('department'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.departments.destroy';
		$modal_id = $id;
		$model = '$department';

		return View('gakko::departments.edit',
			$this->department->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
		return View('gakko::departments.edit',  $this->department->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		DepartmentUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->department->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.department_update') );
		return redirect('admin/departments');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->department->find($id)->delete();

		return Redirect::route('admin.departments.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Department::select(array('departments.id','departments.name','departments.description'))
//			->orderBy('departments.name', 'ASC');
//		$query = Department::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Department::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/departments/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
