<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTblSummary extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tblSummary', function(Blueprint $table) {
           $table->increments('SummaryId');
           $table->text('Summary');
           $table->integer('StatusTypeId')->nullable()->unsigned();
           $table->timestamp('EntryDate')->default(DB::raw('CURRENT_TIMESTAMP'));

           $table->foreign('StatusTypeId')->references('StatusTypeId')->on('tblStatusType');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tblSummary');
	}

}
