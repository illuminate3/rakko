<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Status;
use App\Modules\Gakko\Http\Domain\Repositories\StatusRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\StatusCreateRequest;
use App\Modules\Gakko\Http\Requests\StatusUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class StatusesController extends GakkoController {

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

//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::statuses.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::statuses.create',  $this->status->create());
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
		return redirect('statuses');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$status = $this->status->findOrFail($id);

		return View::make('HR::statuses.show', compact('status'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View('gakko::statuses.edit',  $this->status->edit($id));
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
		return redirect('statuses');
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
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$statuses = Status::select(array('statuses.id','statuses.name','statuses.description'))
			->orderBy('statuses.name', 'ASC');
//dd($statuses);

		return Datatables::of($statuses)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'statuses/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
