<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Room;
use App\Modules\Gakko\Http\Domain\Repositories\RoomRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\RoomCreateRequest;
use App\Modules\Gakko\Http\Requests\RoomUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class RoomsController extends GakkoController {

	/**
	 * Room Repository
	 *
	 * @var Room
	 */
	protected $room;

	public function __construct(
			RoomRepository $room
		)
	{
		$this->room = $room;

		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::rooms.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::rooms.create',  $this->room->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		RoomCreateRequest $request
		)
	{
		$this->room->store($request->all());

		Flash::success( trans('kotoba::hr.success.room_create') );
		return redirect('admin/rooms');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$room = $this->room->findOrFail($id);

		return View::make('HR::rooms.show', compact('room'));
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
		$modal_route = 'admin.rooms.destroy';
		$modal_id = $id;
		$model = '$room';

		return View('gakko::rooms.edit',
			$this->room->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::rooms.edit',  $this->room->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		RoomUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->room->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.room_update') );
		return redirect('admin/rooms');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->room->find($id)->delete();

		return Redirect::route('admin.rooms.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Room::select(array('rooms.id','rooms.name','rooms.description', 'barcode'))
//			->orderBy('rooms.name', 'ASC');
//		$query = Room::select('id', 'name' 'description', 'barcode', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Room::select('id', 'site_id', 'user_id', 'name', 'description', 'barcode', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

// 			-> edit_column(
// 				'site_id',
// 				'@if ($blocked=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
// 				)
// 			-> edit_column(
// 				'user_id',
// 				'@if ($blocked=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
// 				)

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/rooms/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
