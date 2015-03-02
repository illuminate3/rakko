<?php
namespace App\Modules\Gakko\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;

class RoomUpdateRequest extends FormRequest {

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
/*
			$table->integer('site_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->string('barcode')->nullable();
*/
	public function rules()
	{
		return [
			'name'						=> 'required',
			'description'				=> 'required'
		];
	}

}
