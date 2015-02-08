<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration {

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('kagi.kagi_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('password_resets', function(Blueprint $table)
		Schema::create($this->prefix . 'password_resets', function(Blueprint $table)
		{
/*
			$table->string('email')->index();
			$table->string('token')->index();
			$table->timestamp('created_at');
*/

			$table->engine = 'InnoDB';


			$table->string('email')->unique()->index();
			$table->string('token')->index();
//			$table->timestamp('created_at');


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
//		Schema::drop('password_resets');
		Schema::drop($this->prefix . 'password_resets');
	}

}
