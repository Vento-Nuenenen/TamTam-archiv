<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participations', function(Blueprint $table){
            $table->foreign('FK_GRP')->references('id')->on('group');
        });

	    Schema::table('participations_points', function (Blueprint $table) {
		    $table->foreign('FK_PRT')->references('id')->on('participations');
		    $table->foreign('FK_POINT')->references('id')->on('points');
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
