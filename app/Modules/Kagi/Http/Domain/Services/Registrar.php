<?php namespace App\Modules\Kagi\Http\Domain\Services;

//use App\User;
use App\Modules\Kagi\Http\Domain\Models\User as User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
//use Illuminate\Mail\Mailer as Mail;
use Mail;
use Config;

class Registrar implements RegistrarContract {

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
			'password'			=> 'required|confirmed|min:6',
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
//dd($confirmation_code);

		$user = User::create([
			'confirmation_code'	=> $confirmation_code,
			'name'				=> $name,
			'email'				=> $email,
			'password'			=> bcrypt($data['password'])
		]);
//dd($user);

		$this->sendConfirmation($name, $email, $confirmation_code);

		return $user;

	}

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

}
