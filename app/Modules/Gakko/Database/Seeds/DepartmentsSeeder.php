<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class DepartmentsSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('departments')->delete();
			$statement = "ALTER TABLE departments AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$seeds = array(
			array(
				'name' => 'Technology',
				'description' => 'Technology Department'
			),
			array(
				'name' => 'SPED',
				'description' => 'SPED Bldg. 600'
			),
			array(
				'name' => 'Transportation',
				'description' => ''
			),
			array(
				'name' => 'Maintenance',
				'description' => ''
			),
			array(
				'name' => 'Athletics',
				'description' => 'Athletic Department'
			),
			array(
				'name' => 'Parent Center',
				'description' => ''
			),
			array(
				'name' => 'ESL',
				'description' => 'English as a Second Language Department'
			),
			array(
				'name' => 'Food Services',
				'description' => 'Cafeteria'
			),
			array(
				'name' => 'Health Care',
				'description' => 'Nurses'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('departments')->insert($seeds);
	}

}
