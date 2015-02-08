<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use app\User;

class UserRepository {

	/**
	 * @param $userData
	 * @return static
	 */
	public function findByUsernameOrCreate($userData)
	{
		return User::firstOrCreate([
			'name' => $userData->nickname,
			'email'    => $userData->email,
//			'avatar'   => $userData->avatar
		]);
	}
}
