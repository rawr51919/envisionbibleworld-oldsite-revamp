<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUserFeedback extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblUserFeedback', function(Blueprint $table) {
            $table->increments('UserFeedbackId');
            $table->string('UserName');
            $table->string('UserEmail');
            $table->string('UserFeedbackCategory');
            $table->string('UserFeedback');
            $table->string('Summarized')->nullable();
            $table->integer('UserReceivesResponseId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }

}
