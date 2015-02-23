<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Division;
use App\Modules\Gakko\Http\Domain\Repositories\DivisionRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\DivisionCreateRequest;
use App\Modules\Gakko\Http\Requests\DivisionUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
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

//		$this->middleware('admin');
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
		return redirect('divisions');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$division = $this->division->findOrFail($id);

		return View::make('HR::divisions.show', compact('division'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View('gakko::divisions.edit',  $this->division->edit($id));
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
		return redirect('divisions');
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
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$divisions = Division::select(array('divisions.id','divisions.name','divisions.description'))
			->orderBy('divisions.name', 'ASC');
//dd($divisions);

		return Datatables::of($divisions)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'divisions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
