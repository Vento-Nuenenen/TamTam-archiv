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
            $table->foreign('FK_GRP')->references('id')->on('groups')->onDelete('cascade');
        });

	    Schema::table('points', function (Blueprint $table) {
		    $table->foreign('FK_PRT')->references('id')->on('participations')->onDelete('cascade');
	    });
    }
}
