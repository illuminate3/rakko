<?php namespace App\Modules\Kagi\Http\Domain;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\User as UserContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\Passwords\CanResetPasswordTrait;
use Caffeinated\Shinobi\Traits\ShinobiTrait;


class User extends \Model implements UserContract, CanResetPasswordContract {

	use UserTrait, CanResetPasswordTrait, ShinobiTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


}
