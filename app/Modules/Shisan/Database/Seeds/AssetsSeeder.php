<?php
namespace App\Modules\Shisan\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class AssetsSeeder extends Seeder {

	protected $item;

	public function __construct(Item $item, Category $category)
	{
		$this->item = $item;
		$this->category = $category;
	}


	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
// 		DB::table('departments')->delete();
// 			$statement = "ALTER TABLE departments AUTO_INCREMENT = 1;";
// 			DB::unprepared($statement);
//		DB::table('assets')->truncate();

		$csv = dirname(__FILE__) . '/data/' . 'assets.csv';
		$file_handle = fopen($csv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

//			$table->increments('id');
//			$table->integer('user_id')->nullable();
//			$table->integer('item_id')->nullable();
//			$table->integer('site_id')->nullable();
//			$table->integer('room_id')->nullable();
//			$table->integer('asset_status_id')->nullable();
//			$table->string('asset_tag')->nullable();
//			$table->string('serial')->nullable();
//			$table->string('po')->nullable();
//			$table->string('barcode')->nullable();
//			$table->text('note')->nullable();

			$c = array();
			$c['id']				= $line[0];
//			$c['asset_id']			= $line[1];
			$c['site_id']			= $line[2];
			$c['asset_tag']			= $line[3];
			$c['serial']			= $line[4];
			$c['po']				= $line[5];
//			$c['custodian']			= $line[6];
			$c['note']				= $line[6] . '::\r\n' .$line[7];
			$c['created_at']		= $line[8];
			$c['updated_at']		= $line[9];

			$c['barcode']			= $line[3];
			$c['asset_status_id']	= 1;
			$c['room_id']			= 1;
			$c['user_id']			= 1;
			$c['item_id']			= $line[1];

			DB::table('assets')->insert($c);
/*

$id = DB::getPdo()->lastInsertId();

$item_id = $line[1];
$user_id = 1;
$site_id = $line[2];
$room_id = 1;

//$this->attachAsset($id, $item_id);
	$d = array();
	$d['asset_id']				= $id;
	$d['item_id']				= $item_id;
	DB::table('asset_item')->insert($d);

//$this->attachUser($id, $user_id);
	$e = array();
	$e['asset_id']				= $id;
	$e['user_id']				= $user_id;
	DB::table('asset_user')->insert($e);

//$this->attachSite($id, $site_id);
	$f = array();
	$f['asset_id']				= $id;
	$f['site_id']				= $site_id;
	DB::table('asset_site')->insert($f);

//$this->attachRoom($id, $room_id);
	$g = array();
	$g['asset_id']				= $id;
	$g['room_id']				= $room_id;
	DB::table('asset_room')->insert($g);
*/

		}

		fclose($file_handle);

	}

public function attachAsset($id, $item_id)
{
	$item = Asset::find($id);
	$item->items()->attach($item_id);
}

public function attachSite($id, $site_id)
{
	$item = Asset::find($id);
	$item->sites()->attach($site_id);
}

public function attachUser($id, $user_id)
{
	$item = Asset::find($id);
	$item->users()->attach($user_id);
}

public function attachRoom($id, $room_id)
{
	$item = Asset::find($id);
	$item->rooms()->attach($room_id);
}



}
