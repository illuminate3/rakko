<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Employee;
use App\Modules\Gakko\Http\Domain\Repositories\EmployeeRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\EmployeeCreateRequest;
use App\Modules\Gakko\Http\Requests\EmployeeUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
use Flash;

class EmployeesController extends GakkoController {

	/**
	 * Employee Repository
	 *
	 * @var Employee
	 */
	protected $employee;

	public function __construct(
			EmployeeRepository $employee
		)
	{
		$this->employee = $employee;
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
		return View('gakko::employees.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::employees.create',  $this->employee->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		EmployeeCreateRequest $request
		)
	{
		$this->employee->store($request->all());

		Flash::success( trans('kotoba::hr.success.employee_create') );
		return redirect('employees');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View('gakko::employees.show',  $this->employee->show($id));
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
		$modal_route = 'admin.employees.destroy';
		$modal_id = $id;
		$model = '$employee';

		return View('gakko::employees.edit',
			$this->employee->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::employees.edit',  $this->employee->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		EmployeeUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->employee->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.employee_update') );
		return redirect('employees');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->employee->find($id)->delete();

		return Redirect::route('admin.employees.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
		$query = Employee::join('profiles','employees.user_id','=','profiles.id')
			->select(array('employees.id','profiles.first_name','profiles.middle_initial','profiles.last_name','profiles.email_1'));
//		$query = Site::select('id', 'name', 'division_id', 'website', 'user_id');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

// 			-> edit_column(
// 				'division_id',
// 				'{{ $query->present()->divisionName(division_id) }}'
// 				)

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'employees/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
						<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
					</a>
					<a href="{{ URL::to(\'/employees/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data1()
	{
/*
			$table->integer('user_id');
			$table->integer('employee_type_id')->nullable();
			$table->string('department_id',100)->nullable();
			$table->integer('position_id')->nullable();
			$table->integer('secondary_position_id')->nullable();
			$table->integer('job_title_id')->nullable();
			$table->integer('secondary_job_title_id')->nullable();

			$table->integer('isTeacher')->nullable();

			$table->integer('supervisor_id')->nullable();
			$table->integer('isSupervisior')->default(0);

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();
*/
//dd("loaded");
// 		$employees = Employee::select(array('employees.id','employees.user_id','employees.employee_type_id'))
// 			->orderBy('employees.user_id', 'ASC');
//dd($employees);

		$employees = Employee::join('profiles','employees.user_id','=','profiles.id')
				->select(array('employees.id','profiles.first_name','profiles.middle_initial','profiles.last_name','profiles.email_1'));


		return Datatables::of($employees)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions', '
				<a href="{{ URL::to(\'employees/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
					<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
				</a>
				<a href="{{ URL::to(\'employees/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
