<?php
namespace App\Modules\Profiles\Http\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Kagi\Http\Domain\Models\User;

use Laracasts\Presenter\PresentableTrait;

class Profile extends Model {

	use PresentableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';

	protected $presenter = 'App\Modules\Kagi\Http\Presenters\Profile';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
//	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
	protected $fillable = [
		'user_id',
		'first_name',
		'middle_initial',
		'last_name',
		'prefix',
		'suffix',
		'email_1',
		'email_2',
		'phone_1',
		'phone_2',
		'address',
		'city',
		'state',
		'avatar',
		'prefix',
		'notes'
		];


// DEFINE Relationships --------------------------------------------------
	public function user()
	{
		return $this->belongsTo('App\Modules\Kagi\Http\Domain\Models\User');
	}


}
