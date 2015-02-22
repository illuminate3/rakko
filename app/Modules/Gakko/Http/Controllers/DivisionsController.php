<?php namespace HR\controllers;

use HR\models\Division as Division;
use View, Input, Validator, Redirect;
use Bootstrap;

class DivisionsController extends \BaseController {

	/**
	 * Division Repository
	 *
	 * @var Division
	 */
	protected $division;

	public function __construct(Division $division)
	{
		$this->division = $division;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$divisions = $this->division->all();

		return View::make('HR::divisions.index', compact('divisions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::divisions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Division::$rules);

		if ($validation->passes())
		{
			$this->division->create($input);

			return Redirect::route('admin.divisions.index');
		}

		return Redirect::route('admin.divisions.create')
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
		$division = $this->division->findOrFail($id);

		return View::make('HR::divisions.show', compact('division'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$division = $this->division->find($id);

		if (is_null($division))
		{
			return Redirect::route('admin.divisions.index');
		}

		return View::make('HR::divisions.edit', compact('division'));
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
		$validation = Validator::make($input, Division::$rulesUpdate);

		if ($validation->passes())
		{
			$division = $this->division->find($id);
			$division->update($input);

			return Redirect::route('admin.divisions.show', $id);
		}

		return Redirect::route('admin.divisions.edit', $id)
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
		$this->division->find($id)->delete();

		return Redirect::route('admin.divisions.index');
	}

}
