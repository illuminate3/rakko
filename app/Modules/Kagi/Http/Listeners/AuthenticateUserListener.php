<?php
namespace App\Modules\Kagi\Http\Listeners;

interface AuthenticateUserListener {

	/**
	 * @param $user
	 * @return mixed
	 */
	public function userHasLoggedIn($user);

}
