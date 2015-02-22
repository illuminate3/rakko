<?php namespace HR\models;

use Eloquent;
use DB;


class EmployeeType extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employee_types';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();


// DEFINE Rules --------------------------------------------------
	public static $rules = [
		'name' => 'required|unique:employee_types,name'
	];

	public static $rulesUpdate = [
		'name' => 'required'
	];

// DEFINE Fillable --------------------------------------------------
	protected $fillable = array(
		'name', 'description'
	);


// DEFINE Relationships --------------------------------------------------

public function profile()
{
	return $this->hasMany('HR\models\Profile');
}

// Functions --------------------------------------------------

}
