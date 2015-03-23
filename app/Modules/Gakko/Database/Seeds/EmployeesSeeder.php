<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model;

class EmployeesSeeder extends Seeder {

	public function run()
	{

/*
			$table->integer('user_id');
			$table->integer('employee_type_id')->nullable();
			$table->string('department_id',100)->nullable();
			$table->integer('position_id')->nullable();
			$table->integer('secondary_position_id')->nullable();
			$table->integer('job_title_id')->nullable();
			$table->integer('secondary_job_title_id')->nullable();

			$table->integer('isTeacher')->nullable();

			$table->integer('supervisor_id')->nullable();
			$table->integer('isSupervisior')->default(0);

			$table->integer('status_id')->default(1);

			$table->text('notes')->nullable();
*/

// Create Profiles
		DB::table('employees')->delete();
			$statement = "ALTER TABLE employees AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$users = DB::table('users')->get();

		foreach ($users as $user)
		{

			$employees = array(
				'user_id'				=> $user->id,
				'profile_id'			=> $user->id
			);

			DB::table('employees')->insert( $employees );

		}

	} // run


	public function runner()
	{

DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
		DB::table('profiles')->truncate();
		DB::table('profiles')->delete();
			$statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
			DB::unprepared($statement);


// set up standard test users
		$seeds = array(
			array(
				'user_id'			=> 1,
				'first_name'		=> 'Admin',
				'last_name'			=> 'Bryant',
				'email'				=> 'admin@admin.com',
				'picture'			=> 'uni.png'
			),
			array(
				'user_id'			=> 2,
				'first_name'		=> 'User',
				'last_name'			=> 'Benton',
				'email'				=> 'user@user.com',
				'picture'			=> 'usr.png'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('profiles')->insert($seeds);


// grab csv file for the users
			$csv = dirname(__FILE__) . '/data/' . 'users.csv';
			$file_handle = fopen($csv, "r");

			while (!feof($file_handle)) {

				$line = fgetcsv($file_handle);
				if (empty($line)) {
					continue; // skip blank lines
				}

				$c = array();

				$userID = DB::table('users')->where('email', $line[9])->first();
				$c['user_id']		= $userID->id;

				$c['first_name']		= $line[0];
				$c['last_name']			= $line[1];
				$c['address']			= $line[2];
				$c['city']				= $line[3];
				$c['zipcode']			= $line[4];
				$c['employee_type_id']	= $line[5];

/*
				$c['site_id']			= $line[6];
				if (strpos($line[6], ',') !== FALSE) {
	//				$line[6] = trim($line[6], '"');
					$line[6] = serialize(explode(', ', $line[6]));
					$c['site_id']		= $line[6];
				} else {
					$c['site_id']		= $line[6];
				}
*/

//				$c['position_id']		= $line[7];
				$c['job_title_id']		= $line[7];

/*
				$c['grade_id']			= $line[8];
				if (strpos($line[8], ',') !== FALSE) {
	//				$line[8] = trim($line[8], '"');
					$line[8] = explode(', ', $line[8]);
					$c['grade_id']		= serialize($line[8]);
				} else {
					$c['grade_id']		= $line[8];
				}
*/

				$c['email']				= $line[9];
				$c['primary_phone']		= $line[10];
				$c['secondary_phone']	= $line[11];
				$c['secondary_email']	= $line[12];

				DB::table('profiles')->insert($c);
			}

			fclose($file_handle);

DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints

	}


}
