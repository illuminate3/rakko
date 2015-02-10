<?php namespace App\Modules\ModuleManager\Http\Listeners;

interface MMAuthenticateUserListener {

	/**
	 * @param $user
	 * @return mixed
	 */
	public function userHasLoggedIn($user);

}
