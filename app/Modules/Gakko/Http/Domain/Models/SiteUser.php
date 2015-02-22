<?php namespace Vedette\models;

use Eloquent;

use HR\models\Site as Site;
use HR\models\User as User;

class SiteUser extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'site_user';

	/**
	 * The attributes allowed to be mass assigned.
	 *
	 * @var array
	 */
	protected $fillable = array(
		'user_id', 'site_id'
	);

	/**
	 * The timestamps attributes.
	 *
	 * @var boolean
	 */
	public $timestamps = false;


// DEFINE Relationships --------------------------------------------------

	/**
	 * The user relationship.
	 *
	 * @var User
	 */
	public function user()
	{
		return $this->hasOne('Vedette\models\User');
	}

	/**
	 * The site relationship.
	 *
	 * @var Site
	 */
	public function site()
	{
		return $this->hasOne('Vedette\models\Site');
	}
}
