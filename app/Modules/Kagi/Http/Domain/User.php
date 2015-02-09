<?php namespace App\Modules\Kagi\Http\Domain;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPasswordTrait;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\User as UserContract;

use Illuminate\Auth\UserTrait;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Laracasts\Presenter\PresentableTrait;

class User extends Model implements UserContract, AuthenticatableContract, CanResetPasswordContract
//class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use UserTrait, CanResetPasswordTrait, PresentableTrait, Authenticatable, CanResetPassword, ShinobiTrait;
//	use PresentableTrait, Authenticatable, CanResetPassword, ShinobiTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $presenter = 'UserPresenter';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['name', 'email', 'password'];


}
