<?php namespace App\Modules\Profiles\Http\Controllers;

//use HR\models\Profile as Profile;
//use HR\models\User as User;
use View, Input, Validator, Redirect, Auth, Form, DB, Config, Session;
use User;
use Image;
use Bootstrap;
use Datatable;

class ProfilesController1 extends \BaseController {

	/**
	 * Profile Repository
	 *
	 * @var Profile
	 */
	protected $profile;

	public function __construct(Profile $profile, User $user)
	{
		parent::__construct();
		$this->beforeFilter('currentUser', array('only' => 'edit', 'update', 'destroy'));

		$this->profile = $profile;
		$this->user = $user;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$profiles = $this->profile->all();

		return View::make('profiles.index', compact('profiles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

if ( Config::get('vedette.vedette_settings.add_profile') == True ) {
	$email = Session::get('email');
	$user_id = $this->profile->getIDbyEmail($email);
}

$employeeTypes = $this->profile->getEmployeeTypes();
$employeeTypes = array('' => trans('lingos::general.command.select_an') . '&nbsp;' . trans('lingos::hr.employee_type')) + $employeeTypes;

$departments = $this->profile->getDepartments();
$departments = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.department')) + $departments;

$jobTitles = $this->profile->getJobTitles();
$jobTitles = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.job_title')) + $jobTitles;

$grades = $this->profile->getGrades();
$grades = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.grade')) + $grades;

$subjects = $this->profile->getSubjects();
$subjects = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.subject')) + $subjects;

$positions = $this->profile->getPositions();
$positions = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.position')) + $positions;

$sites = $this->profile->getSites();
$sites = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.site')) + $sites;

$supervisors = $this->profile->getSupervisors();
$supervisors = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.supervisor')) + $supervisors;


//		return View::make('profiles.create');
		return View::make(
			'profiles.create',
			compact(
				'employeeTypes', 'departments', 'jobTitles', 'grades', 'subjects', 'positions', 'sites',
				'supervisors', 'user_id', 'email'
			)
		);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		if ( !Auth::User()->hasRoleWithName('Admin') ) {
			return Redirect::to('/')
				->withMessage(Bootstrap::danger( trans('lingos::general.error.forbidden'), true, true));
		}

if ( Config::get('vedette.vedette_settings.add_profile') == True ) {
	$input = array_except(Input::all(), ['_method', 'user_id', '_token']);
} else {
	$input = Input::all();
}


		$validation = Validator::make($input, Profile::$rules);

		if ($validation->passes())
		{

/*
			$picture = Input::file('picture');
			if ($picture) {
				$input['picture'] = Image::upload($picture);
			}
*/

			if ( (Input::get('sites')) != '' ) {
				$this->profile->sites()->sync(Input::get('sites'));
			}
			if ( (Input::get('departments')) != '') {
				$this->profile->departments()->sync(Input::get('departments'));
			}
			if ( (Input::get('grades')) != '') {
				$this->profile->grades()->sync(Input::get('grades'));
			}
/*
			if ( !empty(Input::get('subjects')) ) {
				$this->profile->subjects()->sync(Input::get('subjects'));
			}
			if ( !empty(Input::get('jobtitles')) ) {
				$this->profile->jobtitles()->sync(Input::get('jobtitles'));
			}
*/
			if ( Input::get('employee_type_id') == '' ) {
				$input['employee_type_id'] = NULL;
			}
			if ( Input::get('job_title_id') == '' ) {
				$input['job_title_id'] = NULL;
			}
			if ( Input::get('supervisor_id') == '' ) {
				$input['supervisor_id'] = NULL;
			}
			if ( Input::get('position_id') == '' ) {
				$input['position_id'] = NULL;
			}



if ( Config::get('vedette.vedette_settings.add_profile') == True ) {
	$user_id = $this->profile->getIDbyEmail($input['email']);
	$input['user_id'] = $user_id;

	$this->profile->create($input);
//	$this->profile->update($input);
	return Redirect::route('profiles.index')
		->withMessage(Bootstrap::success(trans('lingos::account.success.create'), true, true));
} else {
	$this->profile->create($input);
	return Redirect::route('profiles.index')
		->withMessage(Bootstrap::success(trans('lingos::account.success.create'), true, true));
}

//dd('loaded');

//			return Redirect::route('profiles.index');
		}

		return Redirect::route('profiles.create')
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
/*
		$profile = $this->profile->findOrFail($id);

		$supervisor = $this->profile->getSupervisor($profile->supervisor_id);

//		$profile['department_id'] =  unserialize( $profile['department_id'] );
		if ( $profile['department_id'] != NULL ) {
			$department_names = '';
			foreach ($profile['department_id'] as $department)
			{
				$department_names[] .= $this->profile->getDepartment($department);
			}
		}
		$profile['grade_id'] =  unserialize( $profile['grade_id'] );

*/
//		$profile = $this->profile->with('grades', 'sites', 'departments', 'subjects')->findOrFail($id);
//dd($id);
		if ( $_ENV['APP_TYPE'] == 'HR' ) {
			$profile = $this->profile->with('grades', 'sites', 'departments')->findOrFail($id);
		} else {
			$profile = $this->profile->findOrFail($id);
		}

		if ($profile->picture) {
			$picture = Image::getPaths($profile->picture);
//dd($picture);
			$picture = $picture['thumb'];
			if (strpos($picture,'https') !== false) {
				$path = '/uploads/logos/thumbs/';
				$new_path = '';
				$picture = str_replace($path, $new_path, $picture);
			}
		} else {
			$picture = null;
		}

		return View::make(
			'profiles.show',
			compact(
//				'profile', 'picture', 'supervisor', 'department_names'
				'profile', 'picture'
			)
		);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$profile = $this->profile->find($id);

		if (is_null($profile))
		{
			return Redirect::route('profiles.index');
		}

/*
		if ($profile->picture) {
			$result = strpos($profile->picture, "://");
			if ($result == true) {
			//dd('found');
				$picture = $profile->picture;
			} else {
			//dd('not found');
//				$picture = Image::getPaths($profile->picture);
				$picture = "asset('/uploads/logos/'". Image::getPaths($profile->picture) . ')';
			}
		} else {
			$picture = null;
		}
*/

/*
$profile['department_id'] =  unserialize( $profile['department_id'] );
$profile['grade_id'] =  unserialize( $profile['grade_id'] );
*/

		$employeeTypes = $this->profile->getEmployeeTypes();
		$employeeTypes = array('' => trans('lingos::general.command.select_an') . '&nbsp;' . trans('lingos::hr.employee_type')) + $employeeTypes;

		$departments = $this->profile->getDepartments();
//		$departments = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.department')) + $departments;

		$jobTitles = $this->profile->getJobTitles();
		$jobTitles = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.job_title')) + $jobTitles;

		$grades = $this->profile->getGrades();
		$grades = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.grade')) + $grades;

		$subjects = $this->profile->getSubjects();
		$subjects = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.subject')) + $subjects;

		$positions = $this->profile->getPositions();
		$positions = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.position')) + $positions;

		$sites = $this->profile->getSites();
//		$sites = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.site')) + $sites;

		$supervisors = $this->profile->getSupervisors();
		$supervisors = array('' => trans('lingos::general.command.select_a') . '&nbsp;' . trans('lingos::hr.supervisor')) + $supervisors;

//		return View::make('profiles.edit', compact('profile'));
		return View::make(
			'profiles.edit',
			compact(
				'profile', 'employeeTypes', 'departments', 'jobTitles', 'grades', 'subjects', 'positions', 'sites',
				'supervisors', 'picture'
			)
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
//dd($id);
//dd(Auth::user()->id);

		if ( (Auth::user()->id == $id ) || (Auth::user()->hasRoleWithName('Admin')) ) {
//		if ( !Auth::User()->hasRoleWithName('Admin') ) {
//			return Redirect::to('/')
//				->withMessage(Bootstrap::danger( trans('lingos::general.error.forbidden'), true, true));
		} else {
			return Redirect::to('/')
				->withMessage(Bootstrap::danger( trans('lingos::general.error.forbidden'), true, true));
		}

		$input = array_except(Input::all(), '_method');
//		$input = array_except(Input::all(), ['_method', 'picture', 'department_id', 'sites', 'grades']);

//$input = serialize( Input::get('department_id'));
//$input = unserialize($input);

//$input['department_id'] =  serialize( Input::get('department_id') );
//$input['grade_id'] =  serialize( Input::get('grade_id') );
//dd($input['grade_id']);

		$validation = Validator::make($input, Profile::$rulesUpdate);

		if ($validation->passes())
		{

			$profile = Profile::findOrFail($id);

if ( (Auth::user()->hasRoleWithName('Admin')) ) {

			if ( (Input::get('sites')) !='') {
				$profile->sites()->sync(Input::get('sites'));
			}
			if ( (Input::get('departments')) !='') {
				$profile->departments()->sync(Input::get('departments'));
			}
			if ( (Input::get('grades')) !='') {
				$profile->grades()->sync(Input::get('grades'));
			}
			if ( (Input::get('subjects')) !='') {
				$profile->subjects()->sync(Input::get('subjects'));
			}
/*
			if ( !empty(Input::get('jobtitles')) ) {
				$profile->jobtitles()->sync(Input::get('jobtitles'));
			}
*/

			$input = array_except(Input::all(), ['_method', 'sites', 'site_id', 'department_id', 'departments', 'grade_id', 'grades', 'subjects', 'subject_id']);
//			$input = array_except(Input::all(), ['_method', 'sites', 'site_id', 'department_id', 'departments', 'grade_id', 'grades', 'jobtitles', 'jobtitle_id']);
//			$input['site_id'] = NULL;
			$input['department_id'] = NULL;
//			$input['grade_id'] = NULL;
//			$input['subject_id'] = NULL;

/*
			if (Input::hasFile('picture'))
			{
				$input['picture'] = Image::upload(Input::file('picture'));
			} else {
				$input['picture'] = Input::get('picture');
			}
			Session::put('userPicture', $input['picture']);
*/

			if ( Input::get('supervisor_id') == '' ) {
				$input['supervisor_id'] = NULL;
			}
			if ( Input::get('employee_type_id') == '' ) {
				$input['employee_type_id'] = NULL;
			}
			if ( Input::get('position_id') == '' ) {
				$input['position_id'] = NULL;
			}
			if ( Input::get('job_title_id') == '' ) {
				$input['job_title_id'] = NULL;
			}
/*
			if ( Input::get('subject_id') == '' ) {
				$input['subject_id'] = NULL;
			}
*/
//dd($input);
}

			$profile->update($input);

			return Redirect::route('profiles.show', $id);
		}

		return Redirect::route('profiles.edit', $id)
			->withInput()
			->withErrors($validation)
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
		$this->profile->find($id)->delete();

		return Redirect::route('profiles.index');
	}

public function profiles() {
	$table = Datatable::table()
		->addColumn('email', 'last_login', 'view')
		->setUrl(route('api.profiles'))
		->noScript();
dd('loaded');
	$this->layout->content = View::make('profiles.index', array('table' => $table));
/*
	$this->layout->content = View::make(
			'profiles.index',
			array(
				'table' => $table
			)
		);
*/
}


	/**
	 * @return mixed
	 */
	public function getDatatable()
	{
//		$query = $this->profile->orderBy('last_name', 'ASC')->get();
		$query = $this->profile->with('grades', 'sites', 'departments')->orderBy('last_name', 'ASC')->get();
//dd($query);


//		$query = $this->profile->orderBy('last_name', 'ASC')->remember(10)->get();
/*
$query = DB::table('users')
	->join('profiles', 'users.id', '=', 'profiles.user_id')
	->get();
*/
//$profiles = $this->profile->orderBy('last_name', 'ASC')->get();




//		return Datatable::collection(Profile::all())
		return Datatable::collection($query)

//			->showColumns('first_name', 'last_name')

			->addColumn('first_name',
				function($model) {
					return $model->first_name;
				})

			->addColumn('last_name',
				function($model) {
					return $model->last_name;
				})

			->addColumn('email',
				function($model) {
					return $model->email;
				})

			->addColumn('jobtitle',
				function($model) {
/*
					if ( $model->position_id == NULL ) {
						return trans('lingos::general.none');
					} else {
						$data = @unserialize($model->position_id);
						if($data !== false || $model->position_id === 'b:0;') {
						// serialized data
							$unserialized = unserialize($model->position_id);
							$return = '';
							foreach ($unserialized as $positionName) {
								$return .=  $this->profile->getPosition($positionName) . ',<br>';
							}
							return trim($return, ',<br>');
						} else {
						//	not serialized data
							return $this->profile->getPosition($model->position_id);
						}
					}
*/
//					return $model->job_title_id;
return $model->present()->jobtitles($model->job_title_id);

				})

			->addColumn('site',
				function($model) {

return $model->present()->sites();
/*
					if ( $model->site_id == NULL ) {
						return trans('lingos::general.none');
					} else {
						$data = @unserialize($model->site_id);
//dd($data);
						if($data !== false || $model->site_id === 'b:0;') {
						// serialized data
							$unserialized = unserialize($model->site_id);
							$return = '';
							foreach ($unserialized as $siteName) {
								$return .=  $this->profile->getSite($siteName) . ',<br>';
							}
							return trim($return, ',<br>');
						} else {
						//	not serialized data
							return $this->profile->getSite($model->site_id);
						}
					}
*/
				})

			->addColumn('actions',
				function($model) {
/*
				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("users.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('lingos::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('lingos::account.ask.delete') . '</h4>
									</div>
									<div class="modal-body">
										<p>' . trans('lingos::account.ask.delete') . '<b>'.$model->id.'</b></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('lingos::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('lingos::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
*/
				$modal =
					'<div class="modal fade" id="delete-Record-'.$model->id.'">
						'.Form::open(array("route" => array("users.destroy", $model->id), "method" => "delete")).'
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">' . trans('lingos::general.close') . '</span></button>
										<h4 class="modal-title">' . trans('lingos::account.ask.delete') . '</h4>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">' . trans('lingos::button.no') . '</button>
										<button type="submit" class="btn btn-success" name="deleteRecord">' . trans('lingos::button.yes') . '</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						'.Form::close().'
					</div><!-- /.modal -->';
//				return

$actions =
					'<a href="/profiles/' . $model->id . '" class="btn btn-primary form-group" title="' . trans('lingos::general.view') . '"><i class="fa fa-chevron-right fa-fw"></i></a>&nbsp;';

if ( Auth::check() ) {
	if (Auth::user()->hasRoleWithName('Admin')) {

		$actions .=
			'<a href="/profiles/' . $model->id . '/edit" class="btn btn-success form-group" title="' . trans(
				'lingos::account.command.edit'
			) . '"><i class="fa fa-edit fa-fw"></i></a>&nbsp;'
			. Form::button(
				'<span class="glyphicon glyphicon-trash"></span>',
				array('name' => 'deleteRecord', 'class' => 'btn btn-danger', 'type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#delete-Record-' . $model->id)
			);

	}
}

$actions .=
					$modal;

return $actions;


				})

			->searchColumns('first_name', 'last_name', 'email', 'jobtitle')
			->orderColumns('first_name', 'last_name', 'email')
			->make();
	}

}
