<?php
namespace App\Modules\Gakko\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Profile extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

	protected $presenter = 'App\modules\ModuleManager\Http\Presenters\Module';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
/*
"name": "ModuleManager",
"slug": "ModuleManager",
"version": "1.0",
"description": "This is the description for the ModuleManager module.",
"enabled": true
*/
	protected $fillable = [
		'id',
		'name',
		'slug',
		'version',
		'description',
		'enabled'
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
