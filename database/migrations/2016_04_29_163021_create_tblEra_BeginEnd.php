<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblEraBeginEnd extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tblEra_BeginEnd', function(Blueprint $table) {
            $table->increments('Era_BeginEndId');
            $table->integer('EraId')->unsigned();
            $table->integer('BeginYearId')->unsigned();
            $table->integer('EndYearId')->unsigned();

            $table->foreign('EraId')->references('EraId')->on('tblEra');
            $table->foreign('BeginYearId', 'EndYearId')->references('Era_YearId')->on('tblEra_Year');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tblEra_BeginEnd');
	}

}
