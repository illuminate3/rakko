<?php
namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KagiDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
//		$this->call('App\Modules\Kagi\Database\Seeds\FoobarTableSeeder');
		$this->call('App\Modules\Kagi\Database\Seeds\UsersTableSeeder');
		$this->call('App\Modules\Kagi\Database\Seeds\RolesTableSeeder');
		$this->call('App\Modules\Kagi\Database\Seeds\PermissionsTableSeeder');

	}

}
