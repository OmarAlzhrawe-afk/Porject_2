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
        Schema::create('educational_level_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('education_level_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::dropIfExists('educational_level_subject');
    }
};
