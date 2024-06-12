<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSubCategory extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSubCategory', function(Blueprint $table) {
            $table->increments('SubcategoryId');
            $table->integer('CategoryId')->unsigned();
            $table->string('Subcategory');
            $table->integer('StatusTypeId')->unsigned()->nullable();
            $table->text('Subcategory_Explanation')->nullable();
            $table->timestamp('EntryDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('CategoryId')->references('CategoryId')->on('tblCategory');
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
        Schema::drop('tblSubCategory');
    }

}
