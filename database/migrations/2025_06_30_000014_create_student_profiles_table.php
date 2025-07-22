<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('student_profiles', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('student_id')->unsigned();
			$table->bigInteger('education_level_id')->unsigned();
			$table->integer('total_absences')->default('0');
			$table->integer('unexcused_absences')->default('0');
			$table->decimal('score')->nullable();
			$table->text('behavior_notes')->nullable();
			$table->text('health_notes')->nullable();
			$table->json('interests')->nullable();
			$table->json('activities_participated')->nullable();
			$table->json('achievements')->nullable();
			$table->text('guardian_feedback')->nullable();
			$table->text('teacher_feedback')->nullable();
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
			$table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('cascade');
			$table->json('skills')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('student_profiles');
	}
};
