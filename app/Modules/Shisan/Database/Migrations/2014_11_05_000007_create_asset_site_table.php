<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssetSiteTable extends Migration
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

			$table->integer('asset_id')->unsigned()->index();
			$table->integer('site_id')->unsigned()->index();

			$table->foreign('asset_id')->references('id')->on($this->prefix.'assets')->onDelete('cascade');
			$table->foreign('site_id')->references('id')->on($this->prefix.'sites')->onDelete('cascade');


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
