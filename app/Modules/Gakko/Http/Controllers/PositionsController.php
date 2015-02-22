<?php namespace HR\controllers;

use HR\models\Position as Position;
use View, Input, Validator, Redirect;
use Bootstrap;

class PositionsController extends \BaseController {

	/**
	 * Position Repository
	 *
	 * @var Position
	 */
	protected $position;

	public function __construct(Position $position)
	{
		$this->position = $position;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$positions = $this->position->all();

		return View::make('HR::positions.index', compact('positions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::positions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Position::$rules);

		if ($validation->passes())
		{
			$this->position->create($input);

			return Redirect::route('admin.positions.index');
		}

		return Redirect::route('admin.positions.create')
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
		$position = $this->position->findOrFail($id);

		return View::make('HR::positions.show', compact('position'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$position = $this->position->find($id);

		if (is_null($position))
		{
			return Redirect::route('admin.positions.index');
		}

		return View::make('HR::positions.edit', compact('position'));
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
		$validation = Validator::make($input, Position::$rulesUpdate);

		if ($validation->passes())
		{
			$position = $this->position->find($id);
			$position->update($input);

			return Redirect::route('admin.positions.show', $id);
		}

		return Redirect::route('admin.positions.edit', $id)
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
		$this->position->find($id)->delete();

		return Redirect::route('admin.positions.index');
	}

}
