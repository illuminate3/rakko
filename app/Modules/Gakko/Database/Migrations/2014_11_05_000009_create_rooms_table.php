<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration
{

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('gakko.gakko_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->prefix . 'rooms', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id');


			$table->integer('site_id')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->string('barcode')->nullable();


			$table->softDeletes();
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->prefix . 'rooms');
	}

}
