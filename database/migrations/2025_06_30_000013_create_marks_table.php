<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('marks', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('student_id');
			$table->unsignedBigInteger('teacher_id');
			$table->unsignedBigInteger('term_id');
			$table->enum('exam_type', array('quiz', 'midterm', 'final', 'homework', 'activity'));
			$table->integer('score')->unsigned()->default('0');
			$table->integer('max_score')->default('10');
			$table->date('date');
			$table->text('teacher_note')->nullable();
			$table->timestamps();
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
			$table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
			$table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('marks');
	}
};
