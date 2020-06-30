<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('scout_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('plz');
            $table->string('place');
            $table->date('birthday');
            $table->string('gender')->nullable();
            $table->string('person_picture')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->integer('seat_number')->nullable();
            $table->boolean('course_passed')->default(false);
            $table->bigInteger('FK_GRP')->unsigned()->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participations');
    }
}
