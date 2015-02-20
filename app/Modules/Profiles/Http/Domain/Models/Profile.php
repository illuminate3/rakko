<?php namespace App\Modules\Profiles\Http\Domain\Models;

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

	protected $presenter = 'App\modules\Kagi\Http\Presenters\Profile';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['name', 'slug', 'description'];


// DEFINE Relationships --------------------------------------------------
	public function user()
	{
		return $this->hasMany('App\Modules\Kagi\Http\Domain\Models\User');
	}



}
