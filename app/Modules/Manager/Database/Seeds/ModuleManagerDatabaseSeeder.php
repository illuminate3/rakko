<?php
namespace App\Modules\Manager\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ManagerDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		Model::unguard();

		$this->call('App\Modules\Manager\Database\Seeds\ModuleSeeder');

	}


}
