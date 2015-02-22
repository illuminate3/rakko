<?php

use Illuminate\Support\Facades\DB;

class JobTitlesSeeder extends Seeder {

	public function run()
	{

		DB::table('job_titles')->delete();
			$statement = "ALTER TABLE job_titles AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$csv = dirname(__FILE__) . '/data/' . 'titles.csv';
		$file_handle = fopen($csv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

			$c = array();
			$c['name']				= $line[0];
			$c['description']		= NULL;

			DB::table('job_titles')->insert($c);
		}

		fclose($file_handle);

	}

}
