<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserTable extends Migration {

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
//		Schema::table('users', function(Blueprint $table)
		Schema::table($this->prefix . 'users', function(Blueprint $table)
		{
			//
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('users', function(Blueprint $table)
		Schema::table($this->prefix . 'users', function(Blueprint $table)
		{
			//
		});
	}

}
