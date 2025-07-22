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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('Title', 255);
            $table->bigInteger('class_room_id')->unsigned()->nullable();
            $table->bigInteger('education_level_id')->unsigned()->nullable();
            $table->text('Description');
            $table->enum('activity_type', array('trip', 'sports', 'art', 'competition', 'course', 'other'));
            $table->date('date');
            $table->string('location', 255)->nullable();
            $table->enum('target_group', array('all', 'class', 'stage', 'specific'));
            $table->boolean('is_paid');
            $table->integer('cost')->nullable();
            $table->integer('seats_limit')->nullable();
            $table->date('registration_deadline');
            $table->boolean('is_open')->default(true);
            $table->json('gallery_urls')->nullable();
            $table->json('required_skills')->nullable();
            $table->boolean('auto_filter_participants');
            $table->foreign('class_room_id')->references('id')->on('class_rooms');
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
        Schema::dropIfExists('activities');
    }
};
