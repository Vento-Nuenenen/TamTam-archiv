<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->string('scout_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('plz');
            $table->string('place');
            $table->date('birthday');
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->integer('seat_number')->nullable();
            $table->boolean('course_passed')->default(false);
            $table->foreignId('group_id')->nullable();
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
};
