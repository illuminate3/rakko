<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

use Illuminate\Support\Facades\DB;

class SitesSeeder extends Seeder {

	public function run()
	{

		DB::table('sites')->delete();
			$statement = "ALTER TABLE sites AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$csv = dirname(__FILE__) . '/data/' . 'sites.csv';
		$file_handle = fopen($csv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

			$c = array();
			$c['ad_code']		= $line[0];
			$c['name']			= $line[1];
			$c['address']		= $line[2];
			$c['primary_phone']	= $line[3];
			$c['division_id']	= $line[4];
			$c['bld_number']	= $line[5];
			$c['website']		= $line[6];
			$c['logo']			= $line[7];
			$c['city']			= $line[8];
			$c['state']			= $line[9];

			DB::table('sites')->insert($c);
		}

		fclose($file_handle);

	}

}
