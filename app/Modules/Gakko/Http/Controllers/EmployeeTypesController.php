<?php namespace HR\controllers;

use HR\models\EmployeeType as EmployeeType;
use View, Input, Validator, Redirect;
use Bootstrap;

class EmployeeTypesController extends \BaseController {

	/**
	 * EmployeeType Repository
	 *
	 * @var EmployeeType
	 */
	protected $employee_type;

	public function __construct(EmployeeType $employee_type)
	{
		$this->employee_type = $employee_type;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$employee_types = $this->employee_type->all();

		return View::make('HR::employee_types.index', compact('employee_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::employee_types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, EmployeeType::$rules);

		if ($validation->passes())
		{
			$this->employee_type->create($input);

			return Redirect::route('admin.employee_types.index');
		}

		return Redirect::route('admin.employee_types.create')
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
		$employee_type = $this->employee_type->findOrFail($id);

		return View::make('HR::employee_types.show', compact('employee_type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$employee_type = $this->employee_type->find($id);

		if (is_null($employee_type))
		{
			return Redirect::route('admin.employee_types.index');
		}

		return View::make('HR::employee_types.edit', compact('employee_type'));
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
		$validation = Validator::make($input, EmployeeType::$rulesUpdate);

		if ($validation->passes())
		{
			$employee_type = $this->employee_type->find($id);
			$employee_type->update($input);

			return Redirect::route('admin.employee_types.show', $id);
		}

		return Redirect::route('admin.employee_types.edit', $id)
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
		$this->employee_type->find($id)->delete();

		return Redirect::route('admin.employee_types.index');
	}

}
