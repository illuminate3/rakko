<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\JobTitle;
use App\Modules\Gakko\Http\Domain\Repositories\JobTitleRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\JobTitleCreateRequest;
use App\Modules\Gakko\Http\Requests\JobTitleUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

use Datatables;
use Flash;

class JobTitlesController extends GakkoController {

	/**
	 * JobTitle Repository
	 *
	 * @var JobTitle
	 */
	protected $job_title;

	public function __construct(
			JobTitleRepository $job_title
		)
	{
		$this->job_title = $job_title;

		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::job_titles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::job_titles.create',  $this->job_title->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		JobTitleCreateRequest $request
		)
	{
		$this->job_title->store($request->all());

		Flash::success( trans('kotoba::hr.success.job_title_create') );
		return redirect('admin/job_titles');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$job_title = $this->job_title->findOrFail($id);
//
// 		return View::make('HR::job_titles.show', compact('job_title'));
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
		$modal_route = 'admin.employee_types.destroy';
		$modal_id = $id;
		$model = '$job_title';

		return View('gakko::job_titles.edit',
			$this->job_title->edit($id),
				compact(
					'modal_title',
					'modal_body',
					'modal_route',
					'modal_id',
					'model'
			));
//		return View('gakko::job_titles.edit',  $this->job_title->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		JobTitleUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->job_title->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.job_title_update') );
		return redirect('admin/job_titles');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->job_title->find($id)->delete();

		return Redirect::route('admin.job_titles.index');
	}

	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = JobTitle::select(array('job_titles.id','job_titles.name','job_titles.description'))
//			->orderBy('job_titles.name', 'ASC');
//		$query = JobTitle::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = JobTitle::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/job_titles/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
