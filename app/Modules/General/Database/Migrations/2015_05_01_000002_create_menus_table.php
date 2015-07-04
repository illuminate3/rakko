<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenusTable extends Migration
{

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('general.general_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->prefix . 'menus', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->string('name');
			$table->string('class')->nullable();

			$table->softDeletes();
			$table->timestamps();

		});

		Schema::create($this->prefix . 'menu_translations', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->boolean('status')->default(0);
			$table->string('title');

			$table->integer('menu_id')->unsigned()->index();
			$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

			$table->integer('locale_id')->unsigned()->index();
			$table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');

			$table->unique(['menu_id', 'locale_id']);

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
		Schema::drop($this->prefix . 'menu_translations');
		Schema::drop($this->prefix . 'menus');
	}


}
