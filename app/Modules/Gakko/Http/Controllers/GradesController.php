<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Grade;
use App\Modules\Gakko\Http\Domain\Repositories\GradeRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\GradeCreateRequest;
use App\Modules\Gakko\Http\Requests\GradeUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
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
		return redirect('admin/grades');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$grade = $this->grade->findOrFail($id);
//
// 		return View::make('HR::grades.show', compact('grade'));
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
		$modal_route = 'admin.grades.destroy';
		$modal_id = $id;
		$model = '$grade';

		return View('gakko::grades.edit',
			$this->grade->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::grades.edit',  $this->grade->edit($id));
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
		return redirect('admin/grades');
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
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Grade::select(array('grades.id','grades.name','grades.description'))
//			->orderBy('grades.name', 'ASC');
//		$query = Grade::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Grade::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/grades/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
