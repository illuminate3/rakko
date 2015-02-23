<?php
namespace App\Modules\Kagi\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Config;

class RegisterRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email'				=> 'required|email|unique:users',
			'password'			=> 'required|confirmed|' . Config::get('kagi.password_min', 'min:6') . '',
		];
	}

}
