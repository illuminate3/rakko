<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSubjectTable extends Migration
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
		Schema::create($this->prefix . 'employee_subject', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';


			$table->integer('employee_id')->unsigned()->index();
			$table->integer('subject_id')->unsigned()->index();

			$table->foreign('employee_id')->references('id')->on($this->prefix.'employees')->onDelete('cascade');
			$table->foreign('subject_id')->references('id')->on($this->prefix.'subjects')->onDelete('cascade');


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
		Schema::drop($this->prefix . 'employee_subject');
	}

}
