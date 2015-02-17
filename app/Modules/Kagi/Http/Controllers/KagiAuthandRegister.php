<?php namespace App\Modules\Kagi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
use App\Modules\Kagi\Http\Domain\Services\Registrar;
use App\Modules\Kagi\Http\Domain\Services\LoginRegistrar;

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
		Request $request
		)
	{
		$this->validate($request, [
			'email' => 'required', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');

		$check = $loginRegistrar->checkUserApproval($request->email);
//dd($check);
		if ( $check != 'true' ) {
			Flash::error(trans('kotoba::auth.error.not_approved'));
			return redirect($this->loginPath());
		}

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			$loginRegistrar->touchLastLogin($request->email);
			return redirect()->intended($this->redirectPath());
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
dd($code);
		if ( Confide::confirm( $code ) )
		{
			return Redirect::to('user/login')
				->with( 'notice', Lang::get('confide::confide.alerts.confirmation') );
		}
		else
		{
			return Redirect::to('user/login')
				->with( 'error', Lang::get('confide::confide.alerts.wrong_confirmation') );
		}
	}


	/**
	 * Signup a new account with the given parameters
	 *
	 * @param  array $input Array containing 'username', 'email' and 'password'.
	 *
	 * @return  User User object that may or may not be saved successfully. Check the id to make sure.
	 */
	public function signup($input)
	{
		$user = new User;
		$user->username = array_get($input, 'username');
		$user->email    = array_get($input, 'email');
		$user->password = array_get($input, 'password');
		// The password confirmation will be removed from model
		// before saving. This field will be used in Ardent's
		// auto validation.
		$user->password_confirmation = array_get($input, 'password_confirmation');
		// Generate a random confirmation code
		$user->confirmation_code     = md5(uniqid(mt_rand(), true));
		// Save if valid. Password field will be hashed before save
		$this->save($user);
		return $user;
	}

    /**
     * Confirm the user (usually means that the user)
     * email is valid. Sets the confirmed attribute of
     * the user to true and also update the database.
     *
     * @return bool Success.
     */
    public function confirm()
    {
        $this->confirmed = true;
        return ConfideFacade::confirm($this->confirmation_code);
    }


	/**
	 * Checks if the given credentials correponds to a user that exists but
	 * is not confirmed
	 *
	 * @param  array $credentials Array containing the credentials (email/username and password)
	 *
	 * @return  boolean Exists and is not confirmed?
	 */
	public function existsButNotConfirmed($input)
	{
		$user = Confide::getUserByEmailOrUsername($input);
		if ($user) {
			$correctPassword = Hash::check(
				isset($input['password']) ? $input['password'] : false,
				$user->password
			);
			return (! $user->confirmed && $correctPassword);
		}
	}


    /**
     * Update the confirmation status of a user to true if a user
     * is found with the given confirmation code.
     *
     * @param string $code
     *
     * @return bool Success
     */
    public function confirmByCode($code)
    {
        $identity = ['confirmation_code' => $code];
        $user = $this->getUserByIdentity($identity);
        if ($user) {
            return $this->confirmUser($user);
        } else {
            return false;
        }
    }
    /**
     * Updated the given user in the database. Set the 'confirmed' attribute to
     * true.
     *
     * @param  ConfideUser User object
     *
     * @return bool Success
     */
    protected function confirmUser($user)
    {
        $user->confirmed = true;
        return $user->save();
    }

}
