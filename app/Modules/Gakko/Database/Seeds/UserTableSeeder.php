<?php

use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {

	/**
	 * Run the seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();
			$statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// set up standard test users
		$seeds = array(
			array(
				'email'				=> 'admin@admin.com',
				'password'			=> Hash::make('vedette'),
				'activation_code'	=> md5(microtime().Config::get('app.key')),
				'activated'			=> 1,
				'verified'			=> 1,
				'created_at'		=> new DateTime,
				'updated_at'		=> new DateTime,
			),
			array(
				'email'				=> 'user@user.com',
				'password'			=> Hash::make('vedette'),
				'activation_code'	=> md5(microtime().Config::get('app.key')),
				'activated'			=> 1,
				'verified'			=> 1,
				'created_at'		=> new DateTime,
				'updated_at'		=> new DateTime,
			),
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($seeds);

		if ( $_ENV['APP_TYPE'] == 'HR' ) {
// grab csv file for the users
			$csv = dirname(__FILE__) . '/data/' . 'users.csv';
			$file_handle = fopen($csv, "r");

			while (!feof($file_handle)) {

				$line = fgetcsv($file_handle);
				if (empty($line)) {
					continue; // skip blank lines
				}

				$c = array();
				$c['email']				= $line[9];
				$c['password']			= NULL;
				$c['activation_code']	= md5(microtime().Config::get('app.key'));
				$c['activated']			= 1;
				$c['verified']			= 1;
				$c['created_at']		= new DateTime;
				$c['updated_at']		= new DateTime;

				DB::table('users')->insert($c);
			}

			fclose($file_handle);
		}

	}

}
