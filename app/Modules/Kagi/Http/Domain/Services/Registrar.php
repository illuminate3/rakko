<?php
namespace App\Modules\Kagi\Http\Domain\Services;

//use App\User;
use App\Modules\Kagi\Http\Domain\Models\User as User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
//use Illuminate\Mail\Mailer as Mail;

use Mail;
use Config;
use DB;

class Registrar implements RegistrarContract {


/*
|--------------------------------------------------------------------------
| Register User
|--------------------------------------------------------------------------
*/

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name'				=> 'required|max:255',
			'email'				=> 'required|email|max:255|unique:users',
//			'password'			=> 'required|confirmed|' . Config::get('kagi.password_min', 'min:6') . '',
//			'password'			=> 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
//dd($data['email']);

		$name = $data['name'];
		$email = $data['email'];
		$confirmation_code = md5(uniqid(mt_rand(), true));
//		$confirmation_code = md5(microtime().Config::get('app.key'));
//dd($confirmation_code);

		$user = User::create([
			'confirmation_code'	=> $confirmation_code,
			'name'				=> $name,
			'email'				=> $email,
			'password'			=> bcrypt($data['password'])
/*
			'activated_at'		=> date("Y-m-d H:i:s"),
			'blocked'			=> 0,
			'confirmed'			=> 1,
			'activated'			=> 1,
			'confirmation_code'	= md5(microtime().Config::get('app.key'))
*/
		]);
//dd($user);

		$this->sendConfirmation($name, $email, $confirmation_code);

		return $user;
	}


	/**
	 * Send confirmation email to user
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function sendConfirmation($name, $email, $confirmation_code)
	{
//dd($user);
		Mail::send('kagi::emails.confirm', ['confirmation_code' => $confirmation_code], function($message) use ($name, $email)
		{
			$message->from(Config::get('kagi.site_email'), Config::get('kagi.site_name'));
			$message->to($email, $name);
			$message->subject(Config::get('kagi.site_name').Config::get('kagi.separator').trans('kotoba::email.confirmation.confirm'));
		});
	}


/*
|--------------------------------------------------------------------------
| Confirm User
|--------------------------------------------------------------------------
*/


	/**
	 * check against db for code
	 *
	 * @param string $code
	 *
	 * @return
	 */
	public function confirmCode($code)
	{
		$confirmation = DB::table('users')
			->where('confirmation_code', '=', $code)
			->where('confirmed', '!=', 1, 'AND')
			->first();
//dd('loaded');

		if ( $confirmation != null) {
			return $confirmation;
		} else {
			return false;
		}
	}

	/**
	 * check against db for code
	 *
	 * @param string $code
	 *
	 * @return
	 */
	public function confirmEmail($email)
	{
		$user = DB::table('users')
			->where('email', '=', $email)
			->first();
//dd('loaded');

		if ( $user != null ) {
			return $user;
		} else {
			return false;
		}

	}

	/**
	 * Change the user confirm status
	 *
	 * @param  $user
	 *
	 * @return
	 */
	public function confirmUser($user)
	{
		$user = User::findOrFail($user->id);
//dd($user);

		$user->confirmed = 1;
		return $user->update();
	}

	/**
	 * Change the user confirm status
	 *
	 * @param  $user
	 *
	 * @return
	 */
	public function activateUser($user)
	{
//dd($user);
		$user = User::find($user->id);

		if ($user != null) {
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");
			return $user->update();
		} else {
			return;
		}
	}


/*
|--------------------------------------------------------------------------
| Module Functions
|--------------------------------------------------------------------------
*/

	public function checkSankaStatus()
	{
//dd('loaded');
		$sanka = DB::table('permissions')
			->where('slug', '=', 'manage_sanka')
//			->where('enabled', '=', '1', 'AND')
			->first();
//dd($sanka);

		return $sanka;
	}

	public function checkJinjiStatus()
	{
//dd('loaded');
		$jinji = DB::table('permissions')
			->where('slug', '=', 'manage_jinji')
//			->where('enabled', '=', '1', 'AND')
			->first();
//dd($sanka);

		return $jinji;
	}

}
