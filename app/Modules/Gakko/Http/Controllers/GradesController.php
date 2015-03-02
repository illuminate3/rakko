<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Grade;
use App\Modules\Gakko\Http\Domain\Repositories\GradeRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\GradeCreateRequest;
use App\Modules\Gakko\Http\Requests\GradeUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class GradesController extends GakkoController {

	/**
	 * Grade Repository
	 *
	 * @var Grade
	 */
	protected $grade;

	public function __construct(
			GradeRepository $grade
		)
	{
		$this->grade = $grade;

//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::grades.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::grades.create',  $this->grade->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		GradeCreateRequest $request
		)
	{
		$this->grade->store($request->all());

		Flash::success( trans('kotoba::hr.success.grade_create') );
		return redirect('grades');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$grade = $this->grade->findOrFail($id);

		return View::make('HR::grades.show', compact('grade'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View('gakko::grades.edit',  $this->grade->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		GradeUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->grade->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.grade_update') );
		return redirect('grades');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->grade->find($id)->delete();

		return Redirect::route('admin.grades.index');
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$grades = Grade::select(array('grades.id','grades.name','grades.description'))
			->orderBy('grades.name', 'ASC');
//dd($grades);

		return Datatables::of($grades)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'grades/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
