<?php
namespace App\Modules\Kagi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Modules\Kagi\Http\Controllers\SocialAuthenticateUser;
use App\Modules\Kagi\Http\Listeners\AuthenticateUserListener;

//use App\Modules\Kagi\Http\Domain\Services\Registrar;
//use App\Modules\Kagi\Http\Domain\Services\LoginRegistrar;

class SocialAuthController extends Controller implements AuthenticateUserListener {

	/**
	 * @param AuthenticateUser $authenticateUser
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function login(
		SocialAuthenticateUser $authenticateUser,
		Request $request
//		LoginRegistrar $loginRegistrar
		)
	{
		$hasCode = $request->has('code');
//dd($hasCode);

		return $authenticateUser->execute($hasCode, $this);
	}

	/**
	 * When a user has successfully been logged in...
	 *
	 * @param $user
	 * @return \Illuminate\Routing\Redirector
	 */
	public function userHasLoggedIn($user)
	{
//dd("social userhaslogged in");
// 		\Event::fire(new \ProfileWasCreated($check));
// 		$this->touchLastLogin($check->id);

		return redirect('/');
	}

}
