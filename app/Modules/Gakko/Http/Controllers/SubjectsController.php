<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Subject;
use App\Modules\Gakko\Http\Domain\Repositories\SubjectRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\SubjectCreateRequest;
use App\Modules\Gakko\Http\Requests\SubjectUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class SubjectsController extends GakkoController {

	/**
	 * Subject Repository
	 *
	 * @var Subject
	 */
	protected $subject;

	public function __construct(
			SubjectRepository $subject
		)
	{
		$this->subject = $subject;

//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::subjects.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::subjects.create',  $this->subject->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		SubjectCreateRequest $request
		)
	{
		$this->subject->store($request->all());

		Flash::success( trans('kotoba::hr.success.subject_create') );
		return redirect('subjects');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$subject = $this->subject->findOrFail($id);

		return View::make('HR::subjects.show', compact('subject'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View('gakko::subjects.edit',  $this->subject->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		SubjectUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->subject->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.subject_update') );
		return redirect('subjects');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->subject->find($id)->delete();

		return Redirect::route('admin.subjects.index');
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$subjects = Subject::select(array('subjects.id','subjects.name','subjects.description'))
			->orderBy('subjects.name', 'ASC');
//dd($subjects);

		return Datatables::of($subjects)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'subjects/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
