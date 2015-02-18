<?php namespace App\Modules\Kagi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
//use Illuminate\Contracts\Auth\Registrar;
use App\Modules\Kagi\Http\Domain\Services\Registrar;
use App\Modules\Kagi\Http\Domain\Services\LoginRegistrar;
//use App\Modules\Kagi\Http\Domain\Services\ConfirmRegistrar;
use App\Modules\Kagi\Http\Requests\Auth\LoginRequest;
use GrahamCampbell\Throttle\Facades\Throttle;
use Illuminate\Support\Facades\Request as FRequest;

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
// let's quickly get the current request object
$request = FRequest::getFacadeRoot();

// now let's get a throttler object for that request
// we'll use the same config as in the previous example
// note that only the first parameter is "required"

$throttler = Throttle::get($request, 50, 30);

// let's check if we've gone over the limit
var_dump($throttler->check());

// we implement Countable
var_dump(count($throttler));

// there are a few more functions available
// please see the previous documentation
// the attempt function will hit the throttle, then return check
var_dump(Throttle::attempt($request));

// so this is the same as writing
var_dump(Throttle::hit($request)->check());

// and, of course, the same as
var_dump(Throttle::get($request)->attempt());
  var_dump($throttler->count());


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
		$check = $loginRegistrar->checkUserApproval($request->email);
//dd($check);


//dd("stop");


/*
if ($this->userRepo->isThrottled($input)) {
dd("tested");

**
 * Tells if the given identity has reached the throttle_limit.
 *
 * @param mixed $identity The login identity.
 *
 * @return bool True if the identity has reached the throttle_limit.
 *
public function isThrottled($identity)
{
	$identity = $this->parseIdentity($identity);
	// Retuns the current count
	$count = $this->countThrottle($identity, 0);
	return $count >= $this->app['config']->get('confide::throttle_limit');
}


**
 * Increments the count for the given string by one stores
 * it into cache and returns the current value for that
 * identity.
 *
 * @param string $identityString
 * @param int    $increments     Amount that is going to be added to the throttling attemps for the given identity.
 *
 * @return int How many times that same string was used.
 *
protected function countThrottle($identityString, $increments = 1)
{
	$count = $this->app['cache']
		->get('login_throttling:'.md5($identityString), 0);
	$count = $count + $increments;
	$ttl = $this->app['config']->get('confide::throttle_time_period');
	$this->app['cache']
		->put('login_throttling:'.md5($identityString), $count, $ttl);
	return $count;
}

}
*/

		if ( $check == true ) {
			if ($this->auth->attempt($credentials, $request->has('remember')))
			{
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
