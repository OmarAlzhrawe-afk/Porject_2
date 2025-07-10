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
        Schema::create('education_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('class_room_id')->unsigned();
            $table->string('title', 50)->nullable();
            $table->text('description')->nullable();
            $table->enum('content_type', array('video', 'pdf', 'link', 'image', 'text', 'quiz'));
            $table->string('file_url', 500)->nullable();
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
        Schema::dropIfExists('education__contents');
    }
};
