<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');

		$statement = "ALTER TABLE employees AUTO_INCREMENT = 2;";
		DB::unprepared($statement);

		$statement = "ALTER TABLE profiles AUTO_INCREMENT = 2;";
		DB::unprepared($statement);

		$statement = "ALTER TABLE users AUTO_INCREMENT = 2;";
		DB::unprepared($statement);


	}

}
