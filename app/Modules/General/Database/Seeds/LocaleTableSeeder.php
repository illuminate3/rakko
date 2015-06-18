<?php
namespace App\Modules\General\Database\Seeds;

use Illuminate\Database\Seeder;

use DB;
use Schema;

class LocaleTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('locales')->delete();

		$seeds = array(
			array(
				'locale'				=> 'en',
				'name'					=> 'English',
				'script'				=> 'Latn',
				'native'				=> 'English',
				'default'				=> 1
			),
			array(
				'locale'				=> 'es',
				'name'					=> 'Spanish',
				'script'				=> 'Latn',
				'native'				=> 'español',
				'default'				=> 0
			)
		);

		// Uncomment the below to run the seeder
		DB::table('locales')->insert($seeds);
	}

}
