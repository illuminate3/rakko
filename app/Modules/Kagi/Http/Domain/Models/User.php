<?php
namespace App\Modules\Kagi\Http\Domain\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Laracasts\Presenter\PresentableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, PresentableTrait, ShinobiTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $presenter = 'App\Modules\Kagi\Http\Presenters\User';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

// DEFINE Fillable -------------------------------------------------------
	protected $fillable = [
		'name',
		'email',
		'password',
		'blocked',
		'banned',
		'confirmed',
		'activated',
		'activated_at',
		'last_login',
		'avatar',
		'confirmation_code'
		];


// DEFINE Relationships --------------------------------------------------
// 	public function roles()
// 	{
// 		return $this->belongsToMany('App\Modules\Kagi\Http\Domain\Models\Role');
// 	}


}
