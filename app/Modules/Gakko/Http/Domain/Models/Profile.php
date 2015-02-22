<?php namespace HR\models;

use HR\helpers\presenters\PresentableTrait;
use Eloquent, DB;


class Profile extends Eloquent {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

	/**
	 * The model presenter.
	 *
	 * @var string
	 */
	protected $presenter = 'HR\helpers\presenters\presenter\Profile';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();


// DEFINE Rules --------------------------------------------------
	public static $rules = [
		'first_name' => 'required|unique:profiles,first_name'
	];

	public static $rulesUpdate = [
		'first_name' => 'required'
	];

// DEFINE Fillable --------------------------------------------------
	protected $fillable = array(
//		'name', 'description'
	);


// DEFINE Relationships --------------------------------------------------
/*
public function site()
{
	return $this->belongsTo('HR\models\Site');
}
*/
public function sites()
{
	return $this->belongsToMany('HR\models\Site');
}


public function grades()
{
	return $this->belongsToMany('HR\models\Grade');
}
public function grade()
{
	return $this->belongsTo('HR\models\Grade');
}


public function departments()
{
	return $this->belongsToMany('HR\models\Department');
}
public function department()
{
	return $this->belongsTo('HR\models\Department');
}


public function positions()
{
	return $this->belongsToMany('HR\models\Position');
}
public function position()
{
	return $this->belongsTo('HR\models\Position');
}


public function subject()
{
	return $this->belongsTo('HR\models\Subject');
}
public function subjects()
{
	return $this->belongsToMany('HR\models\Subject');
}


public function employeeType()
{
	return $this->belongsTo('HR\models\EmployeeType');
}

public function jobTitle()
{
	return $this->belongsTo('HR\models\JobTitle');
}
public function jobTitles()
{
	return $this->belongsToMany('HR\models\JobTitle');
}


public function user()
{
	return $this->belongsTo('User');
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
