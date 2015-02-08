<?php namespace App\Modules\Kagi\Http\Domain\Repositories;

use App\User;

class UserRepository {

	/**
	 * @param $userData
	 * @return static
	 */
	public function findByUsernameOrCreateGithub($userData)
	{
//dd($userData);
		return User::firstOrCreate([
			'name' => $userData->nickname,
			'email'    => $userData->email,
//			'avatar'   => $userData->avatar
		]);
	}

	public function findByUsernameOrCreateGoogle($userData)
	{
//dd($userData);
		return User::firstOrCreate([
			'name' => $userData->name,
			'email'    => $userData->email,
//			'avatar'   => $userData->avatar
		]);
	}
}
