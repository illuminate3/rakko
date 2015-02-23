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
		$departments = $this->department->all();

		return View::make('HR::departments.index', compact('departments'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::departments.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Department::$rules);

		if ($validation->passes())
		{
			$this->department->create($input);

			return Redirect::route('admin.departments.index');
		}

		return Redirect::route('admin.departments.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
		$department = $this->department->find($id);

		if (is_null($department))
		{
			return Redirect::route('admin.departments.index');
		}

		return View::make('HR::departments.edit', compact('department'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Department::$rulesUpdate);

		if ($validation->passes())
		{
			$department = $this->department->find($id);
			$department->update($input);

			return Redirect::route('admin.departments.show', $id);
		}

		return Redirect::route('admin.departments.edit', $id)
			->withInput()
			->withErrors($validation)
//			->with('message', 'There were validation errors.');
			->withMessage(Bootstrap::danger( trans('lingos::general.error.update'), true, true));
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

}
