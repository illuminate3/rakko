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
/*
		$this->call('App\Modules\Gakko\Database\Seeds\ModuleSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\EmployeesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\EmployeeTypesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\DivisionsSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\StatusesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\SitesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\DepartmentsSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\JobTitlesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\GradesSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\SubjectsSeeder');
		$this->call('App\Modules\Gakko\Database\Seeds\JobTitlesSeeder');
*/
		$this->call('App\Modules\Gakko\Database\Seeds\RoomsSeeder');

	}

}
