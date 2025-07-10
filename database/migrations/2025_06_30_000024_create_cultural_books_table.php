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
        Schema::create('cultural_books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('author', 50);
            $table->string('publisher', 50);
            $table->date('publication_year');
            $table->enum('type', array('Paper', 'electronic', 'audio'));
            $table->text('format_url')->nullable();
            $table->integer('copies_available');
            $table->decimal('avg_student_rating');
            $table->string('avg_teacher_rating');
            $table->integer('total_student_reviews');
            $table->bigInteger('total_teacher_reviews');
            $table->text('description');
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
        Schema::dropIfExists('cultural__books');
    }
};
