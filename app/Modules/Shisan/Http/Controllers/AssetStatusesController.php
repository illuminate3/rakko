<?php
namespace App\Modules\Shisan\Http\Controllers;


class AssetStatusesController extends ShisanController {

	/**
	 * AssetStatus Repository
	 *
	 * @var AssetStatus
	 */
	protected $assetStatus;

	public function __construct(AssetStatus $assetStatus)
	{
		$this->assetStatus = $assetStatus;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$assetStatuses = $this->assetStatus->all();

		return View::make('assetStatuses.index', compact('assetStatuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('assetStatuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, AssetStatus::$rules);

		if ($validation->passes())
		{
			$this->assetStatus->create($input);

			return Redirect::route('asset_statuses.index');
		}

		return Redirect::route('asset_statuses.create')
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
		$assetStatus = $this->assetStatus->findOrFail($id);

		return View::make('assetStatuses.show', compact('assetStatus'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$assetStatus = $this->assetStatus->find($id);

		if (is_null($assetStatus))
		{
			return Redirect::route('asset_statuses.index');
		}

		return View::make('assetStatuses.edit', compact('assetStatus'));
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
		$validation = Validator::make($input, AssetStatus::$rules);

		if ($validation->passes())
		{
			$assetStatus = $this->assetStatus->find($id);
			$assetStatus->update($input);

			return Redirect::route('asset_statuses.show', $id);
		}

		return Redirect::route('asset_statuses.edit', $id)
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
		$this->assetStatus->find($id)->delete();

		return Redirect::route('asset_statuses.index');
	}

}
