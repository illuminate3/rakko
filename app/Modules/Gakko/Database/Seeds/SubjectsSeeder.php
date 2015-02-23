<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class SubjectsSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('subjects')->delete();
			$statement = "ALTER TABLE subjects AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$seeds = array(
			array(
				'name' => 'English',
				'description' => 'English'
			),
			array(
				'name' => 'Math',
				'description' => 'Math'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('subjects')->insert($seeds);
	}

}
