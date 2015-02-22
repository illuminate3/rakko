<?php

class PositionsSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('positions')->truncate();

		$seeds = array(
			array(
				'name' => 'Administration',
				'description' => ''
			),
			array(
				'name' => 'Clerical',
				'description' => ''
			),
			array(
				'name' => 'Teacher',
				'description' => ''
			),
			array(
				'name' => 'Special Ed',
				'description' => ''
			),
			array(
				'name' => 'Learning Specialists',
				'description' => ''
			),
			array(
				'name' => 'Aide',
				'description' => ''
			),
			array(
				'name' => 'Nurses',
				'description' => ''
			),
			array(
				'name' => 'Athletics',
				'description' => ''
			),
			array(
				'name' => 'Tech',
				'description' => ''
			),
			array(
				'name' => 'Food Services',
				'description' => ''
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
				'name' => 'Bldg 600',
				'description' => ''
			),
			array(
				'name' => 'Parent Center',
				'description' => ''
			),
			array(
				'name' => 'ESL',
				'description' => ''
			),
		);

		// Uncomment the below to run the seeder
		DB::table('positions')->insert($seeds);
	}

}
