<?php
namespace App\Modules\Gakko\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class ModuleSeeder extends Seeder {

	public function run()
	{

// Module Information
		$module = array(
			'name'					=> 'Gakko',
			'slug'					=> 'gakko',
			'version'				=> '1.0',
			'description'			=> 'School Management System for Rakko',
			'enabled'				=> 1,
			'order'					=> 3
		);

// Insert Module Information
		if (Schema::hasTable('modules'))
		{

			DB::table('modules')->insert( $module );

		}

// Permission Information
		$permissions = array(
			[
				'name'				=> 'Manage School',
				'slug'				=> 'manage_gakko',
				'description'		=> 'Give permission to user to manage the School Managment System'
			],
		 );

// Insert Permissions
		DB::table('permissions')->insert( $permissions );


	} // run


}
