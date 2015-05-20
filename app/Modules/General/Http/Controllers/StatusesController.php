<?php
namespace App\Modules\General\Http\Controllers;

use App\Modules\General\Http\Domain\Models\Status;
use App\Modules\General\Http\Domain\Repositories\StatusRepository;

use Illuminate\Http\Request;
use App\Modules\General\Http\Requests\DeleteRequest;
use App\Modules\General\Http\Requests\StatusCreateRequest;
use App\Modules\General\Http\Requests\StatusUpdateRequest;

use Datatables;
use Flash;
use Theme;

class StatusesController extends GeneralController {

	/**
	 * Status Repository
	 *
	 * @var Status
	 */
	protected $status;

	public function __construct(
			StatusRepository $status
		)
	{
		$this->status = $status;
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
		return Theme::View('modules.general.statuses.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('modules.general.statuses.create',  $this->status->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		StatusCreateRequest $request
		)
	{
		$this->status->store($request->all());

		Flash::success( trans('kotoba::hr.success.status_create') );
		return redirect('admin/statuses');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$status = $this->status->findOrFail($id);
//
// 		return View::make('HR::statuses.show', compact('status'));
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
		$modal_route = 'admin.statuses.destroy';
		$modal_id = $id;
		$model = '$status';

		return Theme::View('modules.general.statuses.edit',
			$this->status->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		StatusUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->status->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.status_update') );
		return redirect('admin/statuses');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->status->find($id)->delete();

		return Redirect::route('admin.statuses.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Status::select(array('statuses.id','statuses.name','statuses.description'))
//			->orderBy('statuses.name', 'ASC');
//		$query = Status::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Status::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/statuses/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
