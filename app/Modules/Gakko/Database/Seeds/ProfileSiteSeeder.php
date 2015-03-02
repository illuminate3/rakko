<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

use Illuminate\Support\Facades\DB;

class ProfileSiteSeeder extends Seeder {

	/**
	 * Run the seeder.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('profile_site')->delete();
			$statement = "ALTER TABLE profile_site AUTO_INCREMENT = 1;";
			DB::unprepared($statement);


		if ( $_ENV['APP_TYPE'] == 'HR' ) {
// grab csv file for the users
			$csv = dirname(__FILE__) . '/data/' . 'profile_site.csv';
			$file_handle = fopen($csv, "r");

			while (!feof($file_handle)) {

				$line = fgetcsv($file_handle);
				if (empty($line)) {
					continue; // skip blank lines
				}

				$c = array();
				$c['profile_id']			= $line[0];
				$c['site_id']				= $line[1];

				DB::table('profile_site')->insert($c);
			}

			fclose($file_handle);
		}


	}

}
