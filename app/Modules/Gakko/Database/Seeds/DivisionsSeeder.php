<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class DivisionsSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('divisions')->truncate();

		$seeds = array(
			array(
				'name' => 'District',
				'description' => 'District'
			),
			array(
				'name' => 'Kindergarten',
				'description' => 'Kindergarten'
			),
			array(
				'name' => 'Elementary School',
				'description' => 'Elementary School'
			),
			array(
				'name' => 'Middle School',
				'description' => 'Middle School'
			),
			array(
				'name' => 'High School',
				'description' => 'High School'
			),
		);

		// Uncomment the below to run the seeder
		DB::table('divisions')->insert($seeds);
	}

}
