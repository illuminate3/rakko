<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('positions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name',100);
			$table->string('description')->nullable();

			$table->softDeletes();
			$table->timestamps();

			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('positions');
	}

}
