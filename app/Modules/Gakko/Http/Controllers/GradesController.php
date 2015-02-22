<?php namespace HR\controllers;

use HR\models\Grade as Grade;
use View, Input, Validator, Redirect;
use Bootstrap;

class GradesController extends \BaseController {

	/**
	 * Grade Repository
	 *
	 * @var Grade
	 */
	protected $grade;

	public function __construct(Grade $grade)
	{
		$this->grade = $grade;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$grades = $this->grade->all();

		return View::make('HR::grades.index', compact('grades'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::grades.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Grade::$rules);

		if ($validation->passes())
		{
			$this->grade->create($input);

			return Redirect::route('admin.grades.index');
		}

		return Redirect::route('admin.grades.create')
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
		$grade = $this->grade->findOrFail($id);

		return View::make('HR::grades.show', compact('grade'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$grade = $this->grade->find($id);

		if (is_null($grade))
		{
			return Redirect::route('admin.grades.index');
		}

		return View::make('HR::grades.edit', compact('grade'));
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
		$validation = Validator::make($input, Grade::$rulesUpdate);

		if ($validation->passes())
		{
			$grade = $this->grade->find($id);
			$grade->update($input);

			return Redirect::route('admin.grades.show', $id);
		}

		return Redirect::route('admin.grades.edit', $id)
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
		$this->grade->find($id)->delete();

		return Redirect::route('admin.grades.index');
	}

}
