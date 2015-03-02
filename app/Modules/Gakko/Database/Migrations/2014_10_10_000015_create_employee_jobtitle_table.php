<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeJobtitleTable extends Migration
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
		Schema::create($this->prefix . 'employee_job_title', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';


			$table->integer('employee_id')->unsigned()->index();
			$table->integer('jobtitle_id')->unsigned()->index();

			$table->foreign('employee_id')->references('id')->on($this->prefix.'employees')->onDelete('cascade');
			$table->foreign('jobtitle_id')->references('id')->on($this->prefix.'job_titles')->onDelete('cascade');


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
		Schema::drop($this->prefix . 'employee_job_title');
	}

}
