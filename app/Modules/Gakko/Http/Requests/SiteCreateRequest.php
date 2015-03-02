<?php
namespace App\Modules\Gakko\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;

class SiteCreateRequest extends FormRequest {

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
			$table->string('name',100)->index();
			$table->string('email',100)->nullable();
			$table->string('phone_1',20)->nullable();
			$table->string('phone_2',20)->nullable();
			$table->string('website',100)->nullable();
			$table->string('address',100)->nullable();
			$table->string('city',100)->nullable();
			$table->string('state',60)->nullable();
			$table->string('zipcode',20)->nullable();
			$table->string('logo',100)->nullable();

			$table->integer('user_id')->default(1);
			$table->integer('division_id')->nullable();
			$table->string('ad_code',10)->nullable();
			$table->string('bld_number',10)->nullable();

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();
*/
	public function rules()
	{
		return [
			'name'						=> 'required',
			'division_id'				=> 'required'
		];
	}

}
