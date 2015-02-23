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
		$subjects = $this->subject->all();

		return View::make('HR::subjects.index', compact('subjects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('HR::subjects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Subject::$rules);

		if ($validation->passes())
		{
			$this->subject->create($input);

			return Redirect::route('admin.subjects.index');
		}

		return Redirect::route('admin.subjects.create')
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
		$subject = $this->subject->find($id);

		if (is_null($subject))
		{
			return Redirect::route('admin.subjects.index');
		}

		return View::make('HR::subjects.edit', compact('subject'));
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
		$validation = Validator::make($input, Subject::$rulesUpdate);

		if ($validation->passes())
		{
			$subject = $this->subject->find($id);
			$subject->update($input);

			return Redirect::route('admin.subjects.show', $id);
		}

		return Redirect::route('admin.subjects.edit', $id)
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
		$this->subject->find($id)->delete();

		return Redirect::route('admin.subjects.index');
	}

}
