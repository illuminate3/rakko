<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class StatusesSentTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('statuses_sent')->truncate();

		$seeds = array(
			array(
				'name' => 'Pending'
			),
			array(
				'name' => 'Processing'
			),
			array(
				'name' => 'Shipped'
			),
			array(
				'name' => 'Processed'
			),
			array(
				'name' => 'Complete'
			),
			array(
				'name' => 'Voided'
			),
			array(
				'name' => 'Canceled'
			),
			array(
				'name' => 'Denied'
			),
			array(
				'name' => 'Canceled Reversal'
			),
			array(
				'name' => 'Failed'
			),
			array(
				'name' => 'Refunded'
			),
			array(
				'name' => 'Reversed'
			),
			array(
				'name' => 'Chargeback'
			),
			array(
				'name' => 'Expired'
			)
		);

		// Uncomment the below to run the seeder
		DB::table('statuses_sent')->insert($seeds);
	}

}
