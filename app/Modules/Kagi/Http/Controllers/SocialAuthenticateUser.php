<?php namespace App\Modules\Kagi\Http\Controllers;

//use Illuminate\Contracts\Auth\Authenticator;
use Illuminate\Contracts\Auth\Guard;
use App\Modules\Kagi\Http\Domain\Repositories\UserRepository;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Modules\Kagi\Http\Listeners\AuthenticateUserListener;
use Config;

class SocialAuthenticateUser {

	/**
	 * @var UserRepository
	 */
	private $users;

	/**
	 * @var Socialite
	 */
	private $socialite;

	/**
	 * @var Guard
	 */
	private $auth;

	/**
	 * @param UserRepository $users
	 * @param Socialite $socialite
	 * @param Guard $auth
	 */
	public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
	{
		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;
	}

	/**
	 * @param boolean $hasCode
	 * @param AuthenticateUserListener $listener
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function execute($hasCode, AuthenticateUserListener $listener)
	{
		if ( ! $hasCode) return $this->getAuthorizationFirst();

		$user = $this->users->findByUsernameOrCreate($this->getGithubUser());

		$this->auth->login($user, true);

		return $listener->userHasLoggedIn($user);
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	private function getAuthorizationFirst()
	{
		$socialType = Config::get('kagi.kagi_social', '');
		return $this->socialite->driver($socialType)->redirect();
	}

	/**
	 * @return \Laravel\Socialite\Contracts\User
	 */
	private function getGithubUser()
	{
		$socialType = Config::get('kagi.kagi_social', '');
		return $this->socialite->driver($socialType)->user();
	}

}
