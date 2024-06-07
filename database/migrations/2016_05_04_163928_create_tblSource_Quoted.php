<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTblSourceQuoted extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('tblSource_Quoted', function(Blueprint $table) {
            $table->increments('Source_QuotedId');
            $table->integer('SourceId')->unsigned();
            $table->integer('BeginChptrSectionMinute')->nullable();
            $table->integer('BeginVersePageSecond')->nullable();
            $table->integer('EndChptrSectionMinute')->nullable();
            $table->integer('EndVersePageSecond')->nullable();
            $table->string('Source_Explanation')->nullable();
            $table->integer('StatusTypeId')->unsigned();
            $table->timestamp('EntryDate')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('SourceId')->references('SourceId')->on('tblSource');
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
        Schema::drop('tblSource_Quoted');
    }

}
