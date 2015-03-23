<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Position;
use App\Modules\Gakko\Http\Domain\Repositories\PositionRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\PositionCreateRequest;
use App\Modules\Gakko\Http\Requests\PositionUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
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
		return redirect('admin/positions');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$position = $this->position->findOrFail($id);
//
// 		return View::make('HR::positions.show', compact('position'));
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
		$modal_route = 'admin.positions.destroy';
		$modal_id = $id;
		$model = '$position';

		return View('gakko::positions.edit',
			$this->position->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::positions.edit',  $this->position->edit($id));
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
		return redirect('admin/positions');
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
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Position::select(array('positions.id','positions.name','positions.description'))
//			->orderBy('positions.name', 'ASC');
//		$query = Position::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Position::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/positions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
