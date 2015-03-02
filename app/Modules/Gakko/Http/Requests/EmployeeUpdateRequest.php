<?php
namespace App\Modules\Gakko\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;

class EmployeeUpdateRequest extends FormRequest {

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
			$table->integer('user_id');
			$table->integer('employee_type_id')->nullable();
			$table->string('department_id',100)->nullable();
			$table->integer('position_id')->nullable();
			$table->integer('secondary_position_id')->nullable();
			$table->integer('job_title_id')->nullable();
			$table->integer('secondary_job_title_id')->nullable();

			$table->integer('isTeacher')->nullable();

			$table->integer('supervisor_id')->nullable();
			$table->integer('isSupervisior')->default(0);

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();
*/
	public function rules()
	{
		return [
			'user_id'					=> 'required',
			'employee_type_id'			=> 'required'
		];
	}

}
