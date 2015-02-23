<?php
namespace App\Modules\Gakko\Http\Domain\Repositories;

use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Profiles\Http\Domain\Models\Profile;

use Hash, DB, Auth;
use DateTime;
//use File, Auth;

class ProfileRepository extends BaseRepository {

	/**
	 * The User instance.
	 *
	 * @var App\Modules\Kagi\Http\Domain\Models\User
	 */
	protected $user;

	/**
	 * The Role instance.
	 *
	 * @var App\Modules\Profiles\Http\Domain\Models\Profile
	 */
	protected $profile;

	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Modules\Kagi\Http\Domain\Models\User $user
	 * @param  App\Modules\Profiles\Http\Domain\Models\Profile $profile
	 * @return void
	 */
	public function __construct(
		User $user,
		Profile $profile
		)
	{
		$this->user = $user;
		$this->profile = $profile;
	}

	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$profile = $this->profile->with('user')->find($id);
//dd($profile);

		return compact('profile');
	}

	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$profile = $this->profile->find($id);
//dd($profile);

// 		$userRoles = User::find($id)->roles;
// 		$roles = $this->shinobiRole->lists('name', 'id');
// 		$allRoles =  $this->role->all()->lists('name', 'id');

// 		return compact('user', 'roles', 'allRoles', 'userRoles');
		return compact('profile');
	}

	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new User;
		$this->model->create($input);
	}

	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
//dd($input);
		$user = $this->getById($id);

		if ( isset($input['name']) ) {
			$user->name = $input['name'];
		}
		if ( isset($input['email']) ) {
			$user->email = $input['email'];
		}

		if ( $input['password'] != NULL ) {
			$user->password = Hash::make($input['password']);
		}

		if ( isset($input['blocked']) ) {
//			$user->blocked = $input['blocked'];
			$user->blocked = 1;
		} else {
			$user->blocked = 0;
		}
		if ( isset($input['banned']) ) {
//			$user->banned = $input['banned'];
			$user->banned = 1;
		} else {
			$user->banned = 0;
		}
		if ( isset($input['confirmed']) ) {
//			$user->confirmed = $input['confirmed'];
			$user->confirmed = 1;
		} else {
			$user->confirmed = 0;
		}
		if ( isset($input['activated']) ) {
//			$user->activated = $input['activated'];
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");

		} else {
			$user->activated = 0;
			$user->activated_at = NULL;
		}
//dd($user);

		$user->update();

		$user->syncRoles($input['roles']);
	}


// Functions --------------------------------------------------

	public function getEmployeeTypes()
	{
		$employee_types = DB::table('employee_types')->lists('name', 'id');
		return $employee_types;
	}

	public function getDepartments()
	{
		$departments = DB::table('departments')->lists('name', 'id');
		return $departments;
	}

	public function getJobTitles()
	{
		$jobTitles = DB::table('job_titles')->lists('name', 'id');
		return $jobTitles;
	}

	public function getGrades()
	{
		$grades = DB::table('grades')->lists('name', 'id');
		return $grades;
	}

	public function getSubjects()
	{
		$subjects = DB::table('subjects')->lists('name', 'id');
		return $subjects;
	}

	public function getPositions()
	{
		$positions = DB::table('positions')->lists('name', 'id');
		return $positions;
	}

	public function getSites()
	{
		$sites = DB::table('sites')->lists('name', 'id');
		return $sites;
	}

	public function getSupervisors()
	{
//		$supervisiors = DB::table('users')->lists('email', 'id');
		$supervisiors = DB::table('profiles')
			->where('isSupervisior', '=', '1')
			->lists('email', 'id');

		return $supervisiors;
	}

	public function getSupervisor($id)
	{
		$supervisor = DB::table('profiles')
			->where('user_id', '=', $id)
			->first();
		return $supervisor;
	}

	public function getDepartment($id)
	{
		$department = DB::table('departments')
			->where('id', '=', $id)
			->pluck('name');
		return $department;
	}

	public function getSite($id)
	{
		$site = DB::table('sites')
			->where('id', '=', $id)
			->pluck('name');
		return $site;
	}

	public function getPosition($id)
	{
		$position = DB::table('job_titles')
			->where('id', '=', $id)
			->pluck('name');
		return $position;
	}

	/**
	 * Has a user profile been associate to a site
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function hasSite($id)
	{

//dd($this->sites);
		foreach ($this->sites as $site)
		{
			if ($site->id == $id)
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Has a user profile been associate to a grade
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function hasGrade($id)
	{

//dd($this->grades);
		foreach ($this->grades as $grade)
		{
			if ($grade->id == $id)
			{
				return true;
			}
		}

		return false;
	}

	/**
	 * Has a user profile been associate to a department
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function hasDepartment($id)
	{

//dd($this->departments);
		foreach ($this->departments as $department)
		{
			if ($department->id == $id)
			{
				return true;
			}
		}

		return false;
	}


	/**
	 * Has a user profile been associate to a subject
	 *
	 * @param integer $id
	 *
	 * @return boolean
	 */
	public function hasSubject($id)
	{

//dd($this->subjects);
		foreach ($this->subjects as $subject)
		{
			if ($subject->id == $id)
			{
				return true;
			}
		}

		return false;
	}


	public function getIDbyEmail($email)
	{
		$id = DB::table('users')
			->where('email', '=', $email)
			->pluck('id');
		return $id;
	}


}
