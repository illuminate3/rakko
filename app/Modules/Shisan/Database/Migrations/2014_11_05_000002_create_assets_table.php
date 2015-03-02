<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetsTable extends Migration
{

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('shisan.shisan_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->prefix . 'departments', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('user_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->integer('site_id')->nullable();
			$table->integer('room_id')->nullable();
			$table->integer('asset_status_id')->nullable();
			$table->string('asset_tag')->nullable();
			$table->string('serial')->nullable();
			$table->string('po')->nullable();
			$table->string('barcode')->nullable();
			$table->text('note')->nullable();


// 			$table->softDeletes();
// 			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->prefix . 'departments');
	}

}
