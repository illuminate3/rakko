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

//		$this->middleware('admin');
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
		return redirect('departments');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$department = $this->department->findOrFail($id);

		return View::make('HR::departments.show', compact('department'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
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
		return redirect('departments');
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
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$departments = Department::select(array('departments.id','departments.name','departments.description'))
			->orderBy('departments.name', 'ASC');
//dd($departments);

		return Datatables::of($departments)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'departments/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
