<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('gakko.gakko_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->prefix . 'employees', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id');


			$table->integer('user_id')->index();
			$table->integer('profile_id')->index();
			$table->integer('employee_type_id')->nullable();


//			$table->string('department_id',100)->nullable();
			$table->integer('position_id')->nullable();
			$table->integer('secondary_position_id')->nullable();
//			$table->integer('job_title_id')->nullable();
			$table->integer('secondary_job_title_id')->nullable();


			$table->integer('isTeacher')->nullable();

			$table->integer('supervisor_id')->nullable();
			$table->integer('isSupervisior')->default(0);

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();


			$table->softDeletes();
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->prefix . 'employees');
	}

}
