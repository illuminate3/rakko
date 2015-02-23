<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeProfileTable extends Migration
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
		Schema::create($this->prefix . 'grade_profile', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';


			$table->integer('grade_id')->unsigned()->index();
			$table->integer('profile_id')->unsigned()->index();

			$table->foreign('grade_id')->references('id')->on($this->prefix.'grades')->onDelete('cascade');
			$table->foreign('profile_id')->references('id')->on($this->prefix.'profiles')->onDelete('cascade');


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
		Schema::drop($this->prefix . 'grade_profile');
	}

}
