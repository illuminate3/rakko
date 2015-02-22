<?php namespace HR\models;

use Eloquent;
use DB;


class JobTitle extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'job_titles';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();


// DEFINE Rules --------------------------------------------------
	public static $rules = [
		'name' => 'required|unique:job_titles,name'
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
