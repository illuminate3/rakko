<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Position;
use App\Modules\Gakko\Http\Domain\Repositories\PositionRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\PositionCreateRequest;
use App\Modules\Gakko\Http\Requests\PositionUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class PositionsController extends GakkoController {

	/**
	 * Position Repository
	 *
	 * @var Position
	 */
	protected $position;

	public function __construct(
			PositionRepository $position
		)
	{
		$this->position = $position;

//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::positions.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::positions.create',  $this->position->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		PositionCreateRequest $request
		)
	{
		$this->position->store($request->all());

		Flash::success( trans('kotoba::hr.success.position_create') );
		return redirect('positions');
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
		return View('gakko::positions.edit',  $this->position->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		PositionUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->position->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.position_update') );
		return redirect('positions');
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


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$positions = Position::select(array('positions.id','positions.name','positions.description'))
			->orderBy('positions.name', 'ASC');
//dd($positions);

		return Datatables::of($positions)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'positions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
