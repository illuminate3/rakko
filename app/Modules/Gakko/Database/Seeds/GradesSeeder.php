<?php

class GradesSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('grades')->delete();
			$statement = "ALTER TABLE grades AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$seeds = array(
			array(
				'name' => '1',
				'description' => '1st Grade'
			),
			array(
				'name' => '2',
				'description' => '2nd Grade'
			),
			array(
				'name' => '3',
				'description' => '3rd Grade'
			),
			array(
				'name' => '4',
				'description' => '4th Grade'
			),
			array(
				'name' => '5',
				'description' => '5th Grade'
			),
			array(
				'name' => '6',
				'description' => '6th Grade'
			),
			array(
				'name' => '7',
				'description' => '7th Grade'
			),
			array(
				'name' => '8',
				'description' => '8th Grade'
			),
			array(
				'name' => '9',
				'description' => '9th Grade'
			),
			array(
				'name' => '10',
				'description' => '10th Grade'
			),
			array(
				'name' => '11',
				'description' => '11th Grade'
			),
			array(
				'name' => '12',
				'description' => '12th Grade'
			),
			array(
				'name' => 'K',
				'description' => 'Kindergarten'
			),
			array(
				'name' => 'Pre-K',
				'description' => 'Pre-Kindergarten'
			),
			array(
				'name' => 'CBI',
				'description' => 'CBI'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('grades')->insert($seeds);
	}

}
