<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentEmployeeTable extends Migration
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

		Schema::create($this->prefix . 'department_employee', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';


			$table->integer('employee_id')->unsigned()->index();
			$table->integer('department_id')->unsigned()->index();

			$table->foreign('department_id')->references('id')->on($this->prefix.'departments')->onDelete('cascade');
			$table->foreign('employee_id')->references('id')->on($this->prefix.'employees')->onDelete('cascade');


// 			$table->softDeletes();
// 			$table->timestamps();

		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->prefix . 'department_employee');
	}

}
