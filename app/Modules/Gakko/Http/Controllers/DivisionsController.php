<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Division;
use App\Modules\Gakko\Http\Domain\Repositories\DivisionRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\DivisionCreateRequest;
use App\Modules\Gakko\Http\Requests\DivisionUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
use Flash;

class DivisionsController extends GakkoController {

	/**
	 * Division Repository
	 *
	 * @var Division
	 */
	protected $division;

	public function __construct(
			DivisionRepository $division
		)
	{
		$this->division = $division;
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
		return View('gakko::divisions.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::divisions.create',  $this->division->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		DivisionCreateRequest $request
		)
	{
		$this->division->store($request->all());

		Flash::success( trans('kotoba::hr.success.division_create') );
		return redirect('admin/divisions');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$division = $this->division->findOrFail($id);
//
// 		return View::make('HR::divisions.show', compact('division'));
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
		$modal_route = 'admin.divisions.destroy';
		$modal_id = $id;
		$model = '$division';

		return View('gakko::divisions.edit',
			$this->division->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::divisions.edit',  $this->division->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		DivisionUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->division->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.division_update') );
		return redirect('admin/divisions');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->division->find($id)->delete();

		return Redirect::route('admin.divisions.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Division::select(array('divisions.id','divisions.name','divisions.description'))
//			->orderBy('divisions.name', 'ASC');
//		$query = Division::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Division::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/divisions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
