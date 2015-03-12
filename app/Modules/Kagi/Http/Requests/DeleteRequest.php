<?php
namespace App\Modules\Kagi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class DeleteRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if (Auth::user()->can('manage_admin')) {
			return true;
		}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
//			'id' => 'required|integer',
		];
	}

}
