<?php
namespace App\Modules\General\Database\Seeds;

use Illuminate\Database\Seeder;

use DB;
use Schema;

class ModuleSeeder extends Seeder {

	public function run()
	{

// Module Information
// 		$module = array(
// 			'name'					=> 'General',
// 			'slug'					=> 'general',
// 			'version'				=> '1.0',
// 			'description'			=> 'General functionality for Rakko',
// 			'enabled'				=> 1,
// 			'order'					=> 3
// 		);

// Insert Module Information
// 		if (Schema::hasTable('modules'))
// 		{

// 			DB::table('modules')->insert( $module );

// 		}

// Permission Information
		$permissions = array(
			[
				'name'				=> 'Manage General',
				'slug'				=> 'manage_general',
				'description'		=> 'Give permission to user to manage General Items'
			],
		 );

// Insert Permissions
		DB::table('permissions')->insert( $permissions );


	} // run


}
