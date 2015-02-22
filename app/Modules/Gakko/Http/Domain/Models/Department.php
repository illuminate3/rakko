<?php namespace HR\models;

use Eloquent;
use DB;

class Department extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'departments';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();


// DEFINE Rules --------------------------------------------------
	public static $rules = [
		'name' => 'required|unique:departments,name'
	];

	public static $rulesUpdate = [
		'name' => 'required'
	];

// DEFINE Fillable --------------------------------------------------
	protected $fillable = array(
		'name', 'description'
	);


// DEFINE Relationships --------------------------------------------------

public function profiles()
{
	return $this->hasMany('HR\models\Profile');
}

public function profile()
{
	return $this->belongsTo('HR\models\Profile');
}


// Functions --------------------------------------------------

}
