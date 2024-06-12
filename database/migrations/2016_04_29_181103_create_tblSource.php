<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSource extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSource', function (Blueprint $table) {
            $table->increments('SourceId');
            $table->string('SourceName');
            $table->integer('LastChptrOrSection')->nullable();
            $table->integer('Source_TypeId')->nullable()->unsigned();
            $table->foreign('Source_TypeId')->references('Source_TypeId')->on('tblSource_Type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblSource_Detail', function (Blueprint $table) {
            $table->dropForeign('tblsource_detail_sourceid_foreign');
        });

        Schema::table('tblSource', function (Blueprint $table) {
            $table->dropIfExists();
        });

        Schema::table('tblSource_Quoted', function (Blueprint $table) {
            $table->dropIfExists();
        });
    }
}
