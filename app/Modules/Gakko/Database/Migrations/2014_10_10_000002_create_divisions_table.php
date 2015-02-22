<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDivisionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('divisions', function(Blueprint $table) {
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
		Schema::drop('divisions');
	}

}
