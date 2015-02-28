<?php
namespace App\Modules\Installer\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InstallerDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

//dd("seeder -- loaded");

		// $this->call('App\Modules\Installer\Database\Seeds\FoobarTableSeeder');
	}

}
