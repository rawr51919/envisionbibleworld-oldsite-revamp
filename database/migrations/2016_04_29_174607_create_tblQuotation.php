<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblQuotation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tblQuotation', function(Blueprint $table) {
            $table->increments('QuotationId');
            $table->longText('Quotation');
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
        Schema::drop('tblQuotation');
	}

}
