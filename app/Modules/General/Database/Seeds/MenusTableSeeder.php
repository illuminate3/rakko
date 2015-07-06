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

class MenusTableSeeder extends Seeder {

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

		$menu_names = array(
		[
			'id'					=> 1,
			'name'					=> 'admin',
			'class'					=> 'nav-menu'
		],
		[
			'id'					=> 2,
			'name'					=> 'footer',
			'class'					=> 'nav-menu'
		]
		);
		$menu_name_trans = array(
		[
			'status'				=> 1,
			'title'					=> 'Admin',
			'menu_id'				=> 1,
			'locale_id'				=> 1
		],
		[
			'status'				=> 1,
			'title'					=> 'administración',
			'menu_id'				=> 1,
			'locale_id'				=> 2
		],
		[
			'status'				=> 1,
			'title'					=> 'Footer',
			'menu_id'				=> 2,
			'locale_id'				=> 1
		],
		[
			'status'				=> 1,
			'title'					=> 'pie de página',
			'menu_id'				=> 2,
			'locale_id'				=> 2
		]
		);

// Create Menus
		DB::table('menus')->delete();
			$statement = "ALTER TABLE menus AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menus')->insert( $menu_names );

// Create Menu Translations
		DB::table('menu_translations')->delete();
			$statement = "ALTER TABLE menu_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menu_translations')->insert( $menu_name_trans );

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
