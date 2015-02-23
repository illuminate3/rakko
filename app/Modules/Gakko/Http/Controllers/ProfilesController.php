<?php
namespace App\Modules\Gakko\Http\Controllers;

use App\Modules\Gakko\Http\Domain\Models\Profile;
use App\Modules\Gakko\Http\Domain\Repositories\ProfileRepository;

use Illuminate\Http\Request;
use App\Modules\Gakko\Http\Requests\ProfileCreateRequest;
use App\Modules\Gakko\Http\Requests\ProfileUpdateRequest;
use App\Modules\Gakko\Http\Requests\DeleteRequest;

//use Datatable;
use Datatables;
//use Bootstrap;
use Flash;

class ProfilesController extends GakkoController {

	/**
	 * Profile Repository
	 *
	 * @var Profile
	 */
	protected $profile;

	public function __construct(
			ProfileRepository $profile
		)
	{
		$this->profile = $profile;

//		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View('gakko::profiles.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('gakko::profiles.create',  $this->profile->create());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		ProfileCreateRequest $request
		)
	{
		$this->profile->store($request->all());

		Flash::success( trans('kotoba::hr.success.profile_create') );
		return redirect('profiles');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$profile = $this->profile->findOrFail($id);

		return View::make('HR::profiles.show', compact('profile'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View('gakko::profiles.edit',  $this->profile->edit($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		ProfileUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->profile->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.profile_update') );
		return redirect('profiles');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->profile->find($id)->delete();

		return Redirect::route('admin.profiles.index');
	}


	/**
	* Show a list of all the languages posts formatted for Datatables.
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//dd("loaded");
		$profiles = Profile::select(array('profiles.id','profiles.name','profiles.description'))
			->orderBy('profiles.name', 'ASC');
//dd($profiles);

		return Datatables::of($profiles)
/*
			-> edit_column(
				'confirmed',
				'@if ($confirmed=="1") <span class="glyphicon glyphicon-ok"></span> @else <span class=\'glyphicon glyphicon-remove\'></span> @endif'
				)
*/
			->add_column(
				'actions',
				'<a href="{{ URL::to(\'profiles/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
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
