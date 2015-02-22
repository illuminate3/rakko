<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function(Blueprint $table) {
			$table->increments('id');

			$table->string('name',100);
			$table->string('email',100)->nullable();
			$table->string('primary_phone',20)->nullable();
			$table->string('secondary_phone',20)->nullable();
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
		Schema::drop('sites');
	}

}
