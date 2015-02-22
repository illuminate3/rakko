<?php namespace App\Modules\Profiles\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class ModuleSeeder extends Seeder {

	public function run()
	{

// Module Information
		$module = array(
			'name'					=> 'Profiles',
			'slug'					=> 'profiles',
			'version'				=> '1.0',
			'description'			=> 'Profiles is a Rakko module that provides the ability to add User Profiles',
			'enabled'				=> 1
		);

// Insert Module Information
		if (Schema::hasTable('modules'))
		{

			DB::table('modules')->insert( $module );

		}

// Permission Information
		$permissions = array(
			[
				'name'				=> 'Manage Profiles',
				'slug'				=> 'manage_profiles',
				'description'		=> 'Give permission to user to access the Profiles area.'
			],
		 );

// Insert Permissions
		DB::table('permissions')->insert( $permissions );


	} // run


}
