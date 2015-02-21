<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleManagerTable extends Migration {

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('modulemanager.module_manager_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
/*
"name": "ModuleManager",
"slug": "ModuleManager",
"version": "1.0",
"description": "This is the description for the ModuleManager module.",
"enabled": true
*/
//dd($this->prefix);
		Schema::create($this->prefix . 'module_manager', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';
			$table->increments('id');


			$table->string('name')->unique()->index();
			$table->string('slug')->unique()->index();
			$table->string('version')->nullable()->index();
			$table->text('version')->nullable();
			$table->boolean('enabled')->nullable()->default('true');


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
		Schema::drop($this->prefix . 'module_manager');
	}

}
