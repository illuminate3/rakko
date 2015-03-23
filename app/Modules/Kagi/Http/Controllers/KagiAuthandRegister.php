<?php
namespace App\Modules\Kagi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Modules\Kagi\Http\Domain\Services\Registrar;
use App\Modules\Kagi\Http\Domain\Services\LoginRegistrar;
use App\Modules\Kagi\Http\Requests\Auth\LoginRequest;
use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Request as FRequest;

use Config;
use Flash;

trait KagiAuthandRegister {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * The registrar implementation.
	 *
	 * @var Registrar
	 */
	protected $registrar;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return View('kagi::auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Foundation\Http\FormRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->registrar->create($request->all());

		Flash::warning(trans('kotoba::email.success.sent'));
		return redirect($this->redirectPath());
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
//dd("loaded");

// get the current request object
//Throttle::clear();
		$request = FRequest::getFacadeRoot();
//dd($request);
// throttler object for that request, X, Y
// X = tries, Y = minutes
		$throttler = Throttle::get($request, Config::get('kagi.throttle', '3'), Config::get('kagi.time_out', '2'));
//dd($throttler);

/*
// check if we've gone over the limit
		var_dump($throttler->check());
// implement Countable
		var_dump($throttler->count());
// the attempt function will hit the throttle, then return check
		var_dump(Throttle::attempt($request));
*/

// Check throttle, return with error
		if (!Throttle::attempt($request, 5)) {
			Flash::error(trans('kotoba::auth.error.not_approved'));
		}

		return View('kagi::auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(
		LoginRegistrar $loginRegistrar,
		LoginRequest $request
		)
	{
		$credentials = $request->only('email', 'password');
		$check = $loginRegistrar->checkUserApproval($request->email);
//dd($check);

		if ( $check == true ) {
			if ($this->auth->attempt($credentials, $request->has('remember')))
			{
//				Throttle::clear();
				$loginRegistrar->touchLastLogin($request->email);
				return redirect()->intended($this->redirectPath());
			}
		} else {
			Flash::error(trans('kotoba::auth.error.not_approved'));
			return redirect($this->loginPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email'))
					->withErrors([
						'email' => trans('kotoba::auth.error.email'),
					]);
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
	}



/*
|--------------------------------------------------------------------------
| Confirm Users
|--------------------------------------------------------------------------
*/

	/**
	 * Attempt to confirm account with code
	 *
	 * @param  string $code
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getConfirm($code)
	{
//dd($code);

		$confirmedCode = $this->registrar->confirmCode($code);

		if ( $confirmedCode == true ) {
//			Flash::success( trans('kotoba::auth.success.confirmation') );
			return View('kagi::auth.confirm')->with(compact("code"));
		} else {
			Flash::error( trans('kotoba::auth.error.confirmation') );
			return View('kagi::auth.confirm')->with(compact("code"));
		}
	}


	/**
	 * Attempt to confirm account with email and then change confirmed status
	 *
	 * @param  string $code
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postConfirm(
		Request $request,
		$code
		)
	{
//dd($code);
		$user = $this->registrar->confirmEmail($request->email);

		if ( $user != null) {
			$this->registrar->confirmUser($user);
			$this->registrar->activateUser($user);

			Flash::success( trans('kotoba::auth.success.login') );
			return redirect($this->redirectPath());
		} else {

			Flash::error( trans('kotoba::auth.error.email') );
			return redirect('auth/confirm/'.$code)
				->withInput($request->only('email'));
		}

	}


}
