<?php
namespace App\Modules\ModuleManager\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ModuleManagerDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\ModuleManager\Database\Seeds\FoobarTableSeeder');
	}

}
