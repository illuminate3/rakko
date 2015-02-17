<?php namespace App\Modules\Kagi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
use App\Modules\Kagi\Http\Domain\Services\Registrar;
use App\Modules\Kagi\Http\Domain\Services\LoginRegistrar;
//use App\Modules\Kagi\Http\Domain\Services\ConfirmRegistrar;

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
//	protected $loginRegistrar;
//	protected $confirmRegistrar;


	/**
	 * Create instance.
	 *
	 * @param  App\Modules\Kagi\Http\Domain\Services\ConfirmRegistrar $confirmRegistrar
	 *
	 * @return void
	 */
/*
	public function __construct(
			ConfirmRegistrar $confirmRegistrar
		)
	{
		$this->confirmRegistrar = $confirmRegistrar;
	}
*/

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

//		$this->auth->login($this->registrar->create($request->all()));
		$this->registrar->create($request->all());
//		$this->auth->login();

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
//		Request $request
		LoginRequest $request
		)
	{
/*
		$this->validate($request, [
			'email' => 'required', 'password' => 'required',
		]);
*/
		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			$check = $loginRegistrar->checkUserApproval($request->email);
//dd($check);

			if ( $check == 'true' ) {
				$loginRegistrar->touchLastLogin($request->email);
				return redirect()->intended($this->redirectPath());
			} else {
				Flash::error(trans('kotoba::auth.error.not_approved'));
				return redirect($this->loginPath());
			}
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
//dd($user);

		if ( $user != NULL) {
			$user = $this->registrar->confirmUser($user);
			$user = $this->registrar->activateUser($user);

			Flash::success( trans('kotoba::auth.success.login') );
			return redirect($this->redirectPath());
		} else {

			Flash::error( trans('kotoba::auth.error.email') );
			return redirect('auth/confirm/'.$code)
				->withInput($request->only('email'));
		}

	}


}
