<?php
namespace App\Modules\Shisan\Http\Controllers;


//use Third\models\Scan as Scan;
//use Third\models\Rack as Rack;
//use Third\models\Pallet as Pallet;

//use View, Input, Validator, Redirect, Session;
//use Bootstrap;

class ScansController extends ShisanController {

	/**
	 * Scan Repository
	 *
	 * @var Scan
	 */
	protected $scan;
	protected $rack;
	protected $pallet;

	public function __construct(Scan $scan, Rack $rack, Pallet $pallet)
	{
		$this->scan = $scan;
		$this->rack = $rack;
		$this->pallet = $pallet;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make('scans.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
/*
	public function create()
	{
		return View::make('scans.pallet');
	}
*/
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
/*
	public function store()
	{
		$input = Input::all();
		$pallet_id = Input::get( 'pallet_id' );

		$validation = Validator::make($input, Scan::$rules);

		if ($validation->passes())
		{
			return Redirect::route('scan_pallets.create')->with('pallet_id', $pallet_id);
		}

		return Redirect::route('scans.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
*/

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
/*
	public function show($id)
	{
		$scan = $this->scan->findOrFail($id);

		return View::make('scans.show', compact('scan'));
	}
*/
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
/*
	public function edit($id)
	{
		$scan = $this->scan->find($id);

		if (is_null($scan))
		{
			return Redirect::route('scans.index');
		}

		return View::make('scans.edit', compact('scan'));
	}
*/
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
/*
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Scan::$rules);

		if ($validation->passes())
		{
			$scan = $this->scan->find($id);
			$scan->update($input);

			return Redirect::route('scans.show', $id);
		}

		return Redirect::route('scans.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}
*/
	/**
	 * Rescan the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
/*
	public function destroy($id)
	{
		$this->scan->find($id)->delete();

		return Redirect::route('scans.index');
	}
*/

	public function getPallet()
	{
		return View::make('scans.pallet');
	}

	public function postPallet()
	{
		$input = Input::all();
		$validation = Validator::make($input, Scan::$rules);

		if ($validation->passes())
		{
			$barcode = Input::get( 'barcode' );
//dd($barcode);
			$pallet = $this->scan->getPallet($barcode);
//dd($pallet);
			if ( !empty($pallet) ) {
				$pallet = $this->pallet->findOrFail($pallet[0]->id);
				return View::make('scans.pallet_show', compact('pallet'));
			} else {
				return Redirect::to('scans/pallet')
//					->withInput()
					->withErrors($validation)
//					->with('message', 'There were validation errors.');
//					->with('message', 'This pallet does not exist in the Database');
					->withMessage(Bootstrap::danger('This pallet does not exist in the DataBase', true, true));
			}
		} else {
			return Redirect::to('scans/pallet')
				->withInput()
				->withErrors($validation)
//				->with('message', 'There were validation errors.');
//				->with('message', 'There were validation Issues.');
//				->with('message', 'This pallet does not exist in the DataBase');
				->withMessage(Bootstrap::danger('This pallet does not exist in the DataBase', true, true));
		}
	}


	public function getRack()
	{
		return View::make('scans.rack');
	}

	public function postRack()
	{
		$input = Input::all();
		$validation = Validator::make($input, Scan::$rulesRack);

//dd($input);

		if ($validation->passes())
		{
			$barcode = Input::get( 'barcode' );
			$rack = $this->scan->getRack($barcode);
//dd($barcode);
//dd($rack);
			if ( !empty($rack) ) {
	//			$rack = $this->rack->findOrFail($rack[0]->id);
				$rack = $this->rack->with('pallet')->findOrFail($rack[0]->id);
				return View::make('scans.rack_show', compact('rack'));
			} else {
				return Redirect::to('scans/index')
					->withInput()
					->withErrors($validation)
//					->with('message', 'This Rack does not exit in the Database');
					->withMessage(Bootstrap::danger( 'This Rack does not exit in the Database', true, true));
			}
		} else {
			return Redirect::to('scans/rack')
				->withInput()
				->withErrors($validation)
//				->with('message', 'There were validation Issues.');
//				->with('message', 'The rack does not exist in the DataBase');
				->withMessage(Bootstrap::danger( 'This Rack does not exit in the Database', true, true));
		}


	}

}
