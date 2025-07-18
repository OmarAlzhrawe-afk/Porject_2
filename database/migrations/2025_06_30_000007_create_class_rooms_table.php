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
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('education_level_id');
            $table->string('name', 50);
            $table->integer('capacity');
            $table->integer('current_count');
            $table->tinyInteger('floor');
            $table->foreign('education_level_id')->references('id')->on('education_levels');
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
        Schema::dropIfExists('class_rooms');
    }
};
