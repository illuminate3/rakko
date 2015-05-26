<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('class')->nullable();

            $table->timestamps();
        });

        Schema::create('menu_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->integer('menu_id')->unsigned();

            $table->string('locale')->index();
            $table->boolean('status')->default(0);

            $table->string('title');

            $table->timestamps();

            $table->unique(array('menu_id', 'locale'));
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_translations');
        Schema::drop('menus');
    }

}
