<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Subject;
use App\Modules\Gakko\Http\Domain\Repositories\SubjectRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\SubjectCreateRequest;
use App\Modules\Gakko\Http\Requests\SubjectUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
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
		return redirect('admin/subjects');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$subject = $this->subject->findOrFail($id);
//
// 		return View::make('HR::subjects.show', compact('subject'));
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
		$modal_route = 'admin.subjects.destroy';
		$modal_id = $id;
		$model = '$subject';

		return View('gakko::subjects.edit',
			$this->subject->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::subjects.edit',  $this->subject->edit($id));
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
		return redirect('admin/subjects');
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
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Subject::select(array('subjects.id','subjects.name','subjects.description'))
//			->orderBy('subjects.name', 'ASC');
//		$query = Subject::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Subject::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/subjects/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
