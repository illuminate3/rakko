<?php
namespace App\Modules\Shisan\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class ShisanDatabaseSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
// 		DB::table('departments')->delete();
// 			$statement = "ALTER TABLE departments AUTO_INCREMENT = 1;";
// 			DB::unprepared($statement);


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\Shisan\Database\Seeds\FoobarTableSeeder');
	}

}
