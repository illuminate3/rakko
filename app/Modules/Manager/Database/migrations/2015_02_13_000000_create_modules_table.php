<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration {

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('manager.module_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
/*
"name": "Manager",
"slug": "Manager",
"version": "1.0",
"description": "This is the description for the Manager module.",
"enabled": true
*/
//dd($this->prefix);
		Schema::create($this->prefix . 'modules', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';
			$table->increments('id');


			$table->string('name')->unique()->index();
			$table->string('slug')->unique()->index();
			$table->string('version')->nullable()->index();
			$table->text('description')->nullable();
			$table->boolean('enabled')->nullable()->default('1');


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
		Schema::drop($this->prefix . 'modules');
	}

}
