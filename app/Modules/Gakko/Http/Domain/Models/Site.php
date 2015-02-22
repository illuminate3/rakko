<?php namespace HR\models;

use HR\helpers\presenters\PresentableTrait;
use Eloquent, DB;


class Site extends Eloquent {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sites';

	/**
	 * The model presenter.
	 *
	 * @var string
	 */
	protected $presenter = 'HR\helpers\presenters\presenter\Site';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	protected $guarded = array();


// DEFINE Rules --------------------------------------------------
	public static $rules = [
		'name' => 'required|unique:sites,name'
	];

	public static $rulesUpdate = [
		'name' => 'required'
	];

// DEFINE Fillable --------------------------------------------------
	protected $fillable = array(
//		'name', 'description'
	);


// DEFINE Relationships --------------------------------------------------

public function profiles()
{
	return $this->belongsToMany('HR\models\Profile');
}
/*
public function profile()
{
	return $this->belongsTo('HR\models\Profile');
}
*/

public function division()
{
	return $this->belongsTo('HR\models\Division');
}

public function user()
{
	return $this->belongsTo('User');
}
public function users()
{
	return $this->hasMany('User');
}


// Functions --------------------------------------------------

	public function getDivisions()
	{
		$divisions = DB::table('divisions')->lists('name', 'id');
		return $divisions;
	}

	public function getContacts()
	{
		$contacts = DB::table('profiles')->lists('email', 'user_id');
//		$contacts = DB::table('profiles')->lists('first_name' . '&nbsp;' . 'last_name', 'user_id');
		if ( empty($contacts) ) {
			$contacts = DB::table('users')->lists('email', 'id');
		}
		return $contacts;
	}

	public function getStatuses()
	{
		$statuses = DB::table('statuses')->lists('name', 'id');
		return $statuses;
	}

	public function getContactUser($id)
	{
		$user = DB::table('profiles')
			->where('user_id', '=', $id)
			->first();
		return $user;
	}

}
