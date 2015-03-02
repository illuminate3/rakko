<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryItemTable extends Migration
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

			$table->integer('category_id')->unsigned()->index();
			$table->integer('item_id')->unsigned()->index();

			$table->foreign('category_id')->references('id')->on($this->prefix.'categories')->onDelete('cascade');
			$table->foreign('item_id')->references('id')->on($this->prefix.'items')->onDelete('cascade');


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
