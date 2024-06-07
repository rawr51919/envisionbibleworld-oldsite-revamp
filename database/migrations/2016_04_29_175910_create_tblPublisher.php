<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTblPublisher extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tblPublisher', function(Blueprint $table) {
            $table->increments('PublisherId');
            $table->string('PublisherName');
            $table->string('Address');

            $table->timestamp('EntryDate')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//        Schema::table('tblSource', function(Blueprint $table){
//            $table->dropIfExists('tblsource_publisherid_foreign');
//        });

//		Schema::table('tblSource_Detail', function(Blueprint $table){
//			$table->dropForeign('tblsource_detail_publisherid_foreign');
//		});

		Schema::drop('tblPublisher');
	}

}
