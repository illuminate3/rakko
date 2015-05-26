<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenulinksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menulinks', function (Blueprint $table) {
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

            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('menulinks')->onDelete('cascade');
        });
        Schema::create('menulink_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('menulink_id')->unsigned();

            $table->string('locale')->index();

            $table->boolean('status')->default(0);

            $table->string('title', 100);
            $table->string('url')->nullable();

            $table->timestamps();

            $table->unique(array('menulink_id', 'locale'));
            $table->foreign('menulink_id')->references('id')->on('menulinks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menulink_translations');
        Schema::drop('menulinks');
    }

}
