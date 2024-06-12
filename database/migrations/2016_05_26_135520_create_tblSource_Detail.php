<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSourceDetail extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSource_Detail', function(Blueprint $table) {
            $table->increments('Source_DetailId');
            $table->integer('SourceId')->unsigned();
            $table->integer('ChptrOfLastVrs')->nullable();
            $table->integer('LastVerseOrPage')->nullable();
            $table->string('ScreenShotName')->nullable();
            $table->integer('PublisherId')->nullable()->unsigned();
            $table->integer('StatusTypeId')->nullable()->unsigned();
            $table->timestamp('EntryDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('SourceId')->references('SourceId')->on('tblSource');
            $table->foreign('PublisherId')->references('PublisherId')->on('tblPublisher');
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
        Schema::table('tblSource_Detail', function(Blueprint $table){
            $table->dropIfExists();
        });
    }

}
