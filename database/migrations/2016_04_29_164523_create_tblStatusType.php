<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblStatusType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('tblStatusType', function(Blueprint $table) {
            $table->increments('StatusTypeId');
            $table->string('StatusType');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('tblSource_Detail', function(Blueprint $table){
//			$table->dropForeign('tblsource_detail_statustypeid_foreign');
//		});
		Schema::drop('tblStatusType');
	}

}
