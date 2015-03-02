<?php
namespace App\Modules\Shisan\Http\Controllers;


class TechStatusesController extends ShisanController {

	/**
	 * TechStatus Repository
	 *
	 * @var TechStatus
	 */
	protected $techStatus;

	public function __construct(TechStatus $techStatus)
	{
		$this->techStatus = $techStatus;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$techStatuses = $this->techStatus->all();

		return View::make('techStatuses.index', compact('techStatuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('techStatuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, TechStatus::$rules);

		if ($validation->passes())
		{
			$this->techStatus->create($input);

			return Redirect::route('tech_statuses.index');
		}

		return Redirect::route('tech_statuses.create')
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
		$techStatus = $this->techStatus->findOrFail($id);

		return View::make('techStatuses.show', compact('techStatus'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$techStatus = $this->techStatus->find($id);

		if (is_null($techStatus))
		{
			return Redirect::route('tech_statuses.index');
		}

		return View::make('techStatuses.edit', compact('techStatus'));
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
		$validation = Validator::make($input, TechStatus::$rules);

		if ($validation->passes())
		{
			$techStatus = $this->techStatus->find($id);
			$techStatus->update($input);

			return Redirect::route('tech_statuses.show', $id);
		}

		return Redirect::route('tech_statuses.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->techStatus->find($id)->delete();

		return Redirect::route('tech_statuses.index');
	}

}
