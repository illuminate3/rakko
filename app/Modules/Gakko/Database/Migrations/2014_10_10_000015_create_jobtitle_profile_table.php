<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobtitleProfileTable extends Migration
{

	public function __construct()
	{
		// Get the prefix
//		$this->prefix = Config::get('vedette::vedette_db.prefix', '');
		$this->prefix = Config::get('vedette.vedette_db.prefix', '');
	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->prefix.'jobtitle_profile', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->integer('jobtitle_id')->unsigned()->index();
			$table->integer('profile_id')->unsigned()->index();

			$table->foreign('jobtitle_id')->references('id')->on($this->prefix.'job_titles')->onDelete('cascade');
			$table->foreign('profile_id')->references('id')->on($this->prefix.'profiles')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->prefix.'jobtitle_profile');
	}

}
