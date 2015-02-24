<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GakkoDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

//		$this->call('App\Modules\Gakko\Database\Seeds\ModuleSeeder');
//		$this->call('App\Modules\Gakko\Database\Seeds\EmployeesSeeder');
//		$this->call('App\Modules\Gakko\Database\Seeds\DivisionsSeeder');
//		$this->call('App\Modules\Gakko\Database\Seeds\StatusesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\SitesSeeder');

	}

}
