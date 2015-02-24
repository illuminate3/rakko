<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class StatusesSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('statuses')->truncate();

		$seeds = array(
			array(
				'name'					=> 'Enabled',
				'description'			=> 'Enabled'
			),
			array(
				'name'					=> 'Diabled',
				'description'			=> 'Diabled'
			)
		);

		// Uncomment the below to run the seeder
		DB::table('statuses')->insert($seeds);
	}

}
