<?php
namespace App\Modules\General\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GeneralDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		Model::unguard();

		$this->call('App\Modules\General\Database\Seeds\ModuleSeeder');
		$this->call('App\Modules\General\Database\Seeds\StatusesSeeder');
		$this->call('App\Modules\General\Database\Seeds\LocaleTableSeeder');

	}


}
