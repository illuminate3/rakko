<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenulinksTables extends Migration
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
		Schema::create($this->prefix . 'menulinks', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

            $table->integer('menu_id')->unsigned();
            $table->integer('page_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->integer('position')->unsigned()->default(0);
            $table->string('target', 10)->nullable();
            $table->string('class')->nullable();
            $table->string('icon_class')->nullable();
            $table->boolean('has_categories')->nullable();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menulinks')->onDelete('cascade');

			$table->softDeletes();
			$table->timestamps();

		});

		Schema::create($this->prefix . 'menulink_translations', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->integer('menu_id')->unsigned();
			$table->string('locale')->index();
			$table->boolean('status')->default(0);
			$table->string('title', 100);
			$table->string('url')->nullable();

			$table->unique(array('menulink_id', 'locale'));
			$table->foreign('menulink_id')->references('id')->on('menulinks')->onDelete('cascade');

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
		Schema::drop($this->prefix . 'menulinks');
	}


}
