<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTblSummaryDetails extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblSummary_Details', function(Blueprint $table) {
            $table->increments('Summary_DetailsId');
            $table->integer('StatusTypeId')->unsigned();
            $table->integer('SacrificeId')->unsigned()->nullable();
            $table->integer('SummaryId')->unsigned();
            $table->integer('Source_QuotedId')->unsigned()->nullable();
            $table->integer('QuotationId')->unsigned();
            $table->integer('LocationId')->unsigned()->nullable();
            $table->integer('EraId')->unsigned();
            $table->integer('SubcategoryId')->unsigned();
            $table->timestamp('EntryDate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('StatusTypeId')->references('StatusTypeId')->on('tblStatusType');
            $table->foreign('SacrificeId')->references('SacrificeId')->on('tblSacrifice');
            $table->foreign('SummaryId')->references('SummaryId')->on('tblSummary');
            $table->foreign('Source_QuotedId')->references('Source_QuotedId')->on('tblSource_Quoted');
            $table->foreign('QuotationId')->references('QuotationId')->on('tblQuotation');
            $table->foreign('LocationId')->references('LocationId')->on('tblLocation');
            $table->foreign('EraId')->references('EraId')->on('tblEra');
            $table->foreign('SubcategoryId')->references('SubcategoryId')->on('tblSubCategory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tblSummary_Details');
    }

}
