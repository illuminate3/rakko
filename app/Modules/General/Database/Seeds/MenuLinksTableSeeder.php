<?php
namespace App\Modules\General\Database\Seeds;

use Illuminate\Database\Seeder;

Use Auth;
use Config;
use DB;
use Eloquent;
use Model;

// use Caffeinated\Shinobi\Models\Role as Role;
// use App\Modules\Kagi\Http\Domain\Models\User as User;
//use App\Modules\Kagi\Http\Domain\Models\Permission as Permission;

class MenuLinksTableSeeder extends Seeder {

/*
	public function __construct(
			Menu $menu,
			MenuTranslation $menu_trans
		)
	{
		$this->menu = $menu;
		$this->menu_trans = $menu_trans;
	}
*/

	public function run()
	{

		$link_names = array(
// admin
		[
			'id'					=> 1,
			'menu_id'				=> 1,
			'position'				=> 0,
		],
		[
			'id'					=> 2,
			'menu_id'				=> 1,
			'position'				=> 1,
		],
// footer
		[
			'id'					=> 3,
			'menu_id'				=> 2,
			'position'				=> 0,
		]
		);
		$ink_name_trans = array(
// admin
		[
			'status'				=> 1,
			'title'					=> 'Menus',
			'url'					=> '/admin/menus',
			'menulink_id'			=> 1,
			'locale_id'				=> 1
		],
		[
			'status'				=> 1,
			'title'					=> 'Menús',
			'url'					=> '/admin/menus',
			'menulink_id'			=> 1,
			'locale_id'				=> 2
		],
		[
			'status'				=> 1,
			'title'					=> 'Locales',
			'url'					=> '/admin/locales',
			'menulink_id'			=> 2,
			'locale_id'				=> 1
		],
		[
			'status'				=> 1,
			'title'					=> 'idiomas',
			'url'					=> '/admin/locales',
			'menulink_id'			=> 2,
			'locale_id'				=> 2
		],
// footer
		[
			'status'				=> 1,
			'title'					=> 'Welcome',
			'url'					=> '/welcome',
			'menulink_id'			=> 3,
			'locale_id'				=> 1
		],
		[
			'status'				=> 1,
			'title'					=> 'bienvenida',
			'url'					=> '/welcome',
			'menulink_id'			=> 3,
			'locale_id'				=> 2
		]

		);

// Create Menus
		DB::table('menulinks')->delete();
			$statement = "ALTER TABLE menulinks AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menulinks')->insert( $link_names );

// Create Roles
		DB::table('menulink_translations')->delete();
			$statement = "ALTER TABLE menulink_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menulink_translations')->insert( $ink_name_trans );

/*
// Attach permission to role
		$role = $this->role->find(1);
		$role->syncPermissions([1]);
		$role = $this->role->find(2);
		$role->syncPermissions([2]);

// Attach role to user
		$user = User::find(1);
		$user->roles()->attach(1);
		$user = User::find(2);
		$user->roles()->attach(2);
*/

	} // run


}
