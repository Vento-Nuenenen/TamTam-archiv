<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->foreign('FK_GRP')->references('id')->on('groups')->onDelete('cascade');
        });

        Schema::table('points', function (Blueprint $table) {
            $table->foreign('FK_PRT')->references('id')->on('participations')->onDelete('cascade');
        });
    }
};
