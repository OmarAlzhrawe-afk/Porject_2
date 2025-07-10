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
        Schema::create('class_teachers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_room_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->text('notes');
            $table->boolean('is_primary_teacher')->nullable();
            $table->integer('weekly_lessons_count');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('class_room_id')->references('id')->on('class_rooms');
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
        Schema::dropIfExists('class_teachers');
    }
};
