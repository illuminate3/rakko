<?php
namespace App\Modules\Kagi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;

class UserCreateRequest extends FormRequest {

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
			'name'						=> 'required|min:3|unique:users',
			'email'						=> 'required|email|unique:users',
//			'email'						=> 'required|email',
//			'password'					=> 'required|confirmed|' . Config::get('kagi.password_min', 'min:6') . '',
			'password'					=> 'required|confirmed|min:4',
			'password_confirmation'		=> 'required_with:password'
		];
	}

}
