<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

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
//dd($this->prefix);

//		Schema::create('users', function(Blueprint $table)
		Schema::create($this->prefix . 'users', function(Blueprint $table)
		{
/*
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
*/

			$table->engine = 'InnoDB';
			$table->increments('id');


			$table->string('name');
			$table->string('email')->unique()->index();
			$table->string('password')->nullable()->index();

//			$table->string('remember_token')->nullable()->index();
//			$table->rememberToken();
			$table->rememberToken()->nullable()->index();
			$table->string('reset_password_code')->nullable();

			$table->boolean('verified')->default(0);
			$table->boolean('disabled')->default(0);
			$table->string('confirmation_code')->nullable();
			$table->boolean('confirmed')->default(false);

			$table->boolean('activated')->default(0);
			$table->timestamp('activated_at')->nullable();
			$table->string('activation_code')->nullable()->index();

			$table->timestamp('last_login')->nullable();




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
//		Schema::drop('users');
		Schema::drop($this->prefix . 'users');
	}

}
