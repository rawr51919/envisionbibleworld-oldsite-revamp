<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSourceScreenShot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schmea::create('tblSource_ScreenShot', function(Blueprint $table) {
			$table->increments('Source_ScreenShotId');
			$table->integer('SourceId')->unsigned();
			$table->string('ScreenShotName');

			$table->foreign('SourceId')->references('SourceId')->on('tblSource');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tblSource_ScreenShot');
	}

}
