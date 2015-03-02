<?php
namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;
Use Auth, Config, DB, Eloquent, Model;

use Caffeinated\Shinobi\Models\Role as Role;
use App\Modules\Kagi\Http\Domain\Models\User as User;
//use App\Modules\Kagi\Http\Domain\Models\Permission as Permission;

class UsersTableSeeder extends Seeder {

	public function __construct(
			User $user,
//			Permission $permission,
			Role $role
		)
	{
		$this->user = $user;
//		$this->permission = $permission;
		$this->role = $role;
	}

	public function run()
	{

		$user = array(
			'name'					=> 'admin',
			'email'					=> 'admin@admin.com',
			'password'				=> bcrypt('kagiadmin'),
			'activated_at'			=> date("Y-m-d H:i:s"),
			'created_at'			=> date("Y-m-d H:i:s"),
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'confirmation_code'		=> md5(microtime().Config::get('app.key'))
		);

		$permissions = array(
			[
				'name'				=> 'Manage Admin',
				'slug'				=> 'manage_admin',
				'description'		=> 'Give permission to user to access the admin area.'
			],
			[
				'name'				=> 'User',
				'slug'				=> 'user',
				'description'		=> 'Only front end permissions'
			],
		 );

		$roles = array(
			[
				'name'				=> 'Admin',
				'slug'				=> 'admin',
				'description'		=> 'Give user full permission to site functions.'
			],
			[
				'name'				=> 'User',
				'slug'				=> 'user',
				'description'		=> 'Standard User'
			],
		 );

// Create Permissions
		DB::table('permissions')->delete();
			$statement = "ALTER TABLE permissions AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('permissions')->insert( $permissions );

// Create Roles
		DB::table('roles')->delete();
			$statement = "ALTER TABLE roles AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('roles')->insert( $roles );

// Clear relationships
		DB::table('permission_role')->delete();
			$statement = "ALTER TABLE permission_role AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		DB::table('role_user')->delete();
			$statement = "ALTER TABLE role_user AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// Create Users
		DB::table('users')->delete();
			$statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('users')->insert($user);

// Attach permission to role
		$role = $this->role->find(1);
		$role->syncPermissions([1]);

// Attach role to user
		$user = User::find(1);
		$user->roles()->attach(1);

	} // run


}
