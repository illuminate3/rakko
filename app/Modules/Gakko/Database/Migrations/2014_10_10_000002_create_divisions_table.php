<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDivisionsTable extends Migration
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
		Schema::create($this->prefix . 'divisions', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id');


			$table->string('name',100)->index();
			$table->string('description')->nullable();


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
		Schema::drop($this->prefix . 'divisions');
	}

}
