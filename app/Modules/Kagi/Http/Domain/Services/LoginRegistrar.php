<?php namespace App\Modules\Kagi\Http\Domain\Services;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Kagi\Http\Domain\Models\User;
use App\Modules\Kagi\Http\Domain\Models\Role;

use Hash, Input, DB, Eloquent;
use DateTime;
//use File, Auth;

class LoginRegistrar extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Update user login timestamp
	 *
	 * @param  int  $email
	 * @return
	 */
	public function touchLastLogin($email)
	{
		$id = DB::table('users')
			->where('email', '=', $email)
			->pluck('id');

		$user = $this->findOrFail($id);
		$user->last_login = new DateTime;

		$user->update();
	}

	/**
	 * Check user if approved to access site
	 *
	 * @param  int  $email
	 * @return
	 */
	public function checkUserApproval($email)
	{
		$id = DB::table('users')
			->where('email', '=', $email)
			->pluck('id');

		$user = $this->find($id);
//dd($user);

// Run authorization checks against user status
		$approved = false;
		if ($user != null) {
			if ( $user->confirmed == 1) {
				$approved = true;
			}
			if ( $user->activated == 1) {
				$approved = true;
			}
			if ( $user->blocked == 1) {
				$approved = false;
			}
			if ( $user->banned == 1) {
				$approved = false;
			}
		}
//dd($approved);

		return $approved;
	}


}
