<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSourceType extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSource_Type', function(Blueprint $table) {
            $table->increments('Source_TypeId');
            $table->string('Source_Type');
            $table->char('Source_Type_Abbreviation', 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('tblSource', function(Blueprint $table){
           $table->dropForeign('tblsource_source_typeid_foreign');
       });
        Schema::drop('tblSource_Type');
    }

}
