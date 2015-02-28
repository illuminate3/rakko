<?php
namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class ModuleSeeder extends Seeder {

	public function run()
	{

		$module = array(
			'name'					=> 'Kagi',
			'slug'					=> 'kagi',
			'version'				=> '1.0',
			'description'			=> 'Kagi is a module for Laravel 5 Authentification and Authorization',
			'enabled'				=> 1,
			'order'					=> 2,
		);


// Insert Module Information
		if (Schema::hasTable('modules'))
		{
			DB::table('modules')->insert( $module );
		}

// Permissions are in the Users Table Seeder


	} // run


}
