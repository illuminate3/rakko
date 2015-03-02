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

//		$this->middleware('admin');
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
		return redirect('rooms');
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
		return View('gakko::rooms.edit',  $this->room->edit($id));
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
		return redirect('rooms');
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
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
/*
			$table->integer('site_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->string('barcode')->nullable();
*/
		$rooms = Room::select(array('rooms.id','rooms.name','rooms.description'))
			->orderBy('rooms.name', 'ASC');
//dd($rooms);

		return Datatables::of($rooms)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'rooms/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
