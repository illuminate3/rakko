<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\JobTitle;
use App\Modules\Gakko\Http\Domain\Repositories\JobTitleRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\JobTitleCreateRequest;
use App\Modules\Gakko\Http\Requests\JobTitleUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
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

//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$job_titles = $this->job_title->all();

		return View::make('HR::job_titles.index', compact('job_titles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::job_titles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, JobTitle::$rules);

		if ($validation->passes())
		{
			$this->job_title->create($input);

			return Redirect::route('admin.job_titles.index');
		}

		return Redirect::route('admin.job_titles.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$job_title = $this->job_title->findOrFail($id);

		return View::make('HR::job_titles.show', compact('job_title'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$job_title = $this->job_title->find($id);

		if (is_null($job_title))
		{
			return Redirect::route('admin.job_titles.index');
		}

		return View::make('HR::job_titles.edit', compact('job_title'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, JobTitle::$rulesUpdate);

		if ($validation->passes())
		{
			$job_title = $this->job_title->find($id);
			$job_title->update($input);

			return Redirect::route('admin.job_titles.show', $id);
		}

		return Redirect::route('admin.job_titles.edit', $id)
			->withInput()
			->withErrors($validation)
//			->with('message', 'There were validation errors.');
			->withMessage(Bootstrap::danger( trans('lingos::general.error.update'), true, true));
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

}
