<?php
namespace App\Modules\Manager\Http\Listeners;

interface MMAuthenticateUserListener {

	/**
	 * @param $user
	 * @return mixed
	 */
	public function userHasLoggedIn($user);

}
