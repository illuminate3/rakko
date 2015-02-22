<?php

class EmployeeTypesSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('employee_types')->truncate();

		$seeds = array(
			array(
				'name' => 'Certified',
				'description' => 'Certified Staff'
			),
			array(
				'name' => 'Classified',
				'description' => 'Classified Staff'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('employee_types')->insert($seeds);
	}

}
