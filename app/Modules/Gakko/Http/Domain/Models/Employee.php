<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Employee extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employees';

	protected $presenter = 'App\modules\Gakko\Http\Presenters\Employee';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
/*
			$table->integer('user_id');
			$table->integer('employee_type_id')->nullable();
			$table->string('department_id',100)->nullable();
			$table->integer('position_id')->nullable();
			$table->integer('secondary_position_id')->nullable();
			$table->integer('job_title_id')->nullable();
			$table->integer('secondary_job_title_id')->nullable();

			$table->integer('isTeacher')->nullable();

			$table->integer('supervisor_id')->nullable();
			$table->integer('isSupervisior')->default(0);

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();
*/
	protected $fillable = [
		'id',
		'user_id',
		'employee_type_id',
		'department_id',
		'position_id',
		'secondary_position_id',
		'job_title_id',
		'secondary_job_title_id',
		'isTeacher',
		'supervisor_id',
		'isSupervisior',
		'status_id',
		'notes'
		];

// DEFINE Relationships --------------------------------------------------
/*
public function site()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\Site');
}
*/
public function sites()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\Models\Site');
}


public function grades()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\Models\Grade');
}
public function grade()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\Grade');
}


public function departments()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\Models\Department');
}
public function department()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\Department');
}


public function positions()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\Models\Position');
}
public function position()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\Position');
}


public function subject()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\Subject');
}
public function subjects()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\Models\Subject');
}


public function employeeType()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\EmployeeType');
}

public function jobTitle()
{
	return $this->belongsTo('App\Modules\Gakko\Http\Domain\Models\JobTitle');
}
public function jobTitles()
{
	return $this->belongsToMany('App\Modules\Gakko\Http\Domain\Models\JobTitle');
}


public function user()
{
	return $this->belongsTo('User');
}


}
