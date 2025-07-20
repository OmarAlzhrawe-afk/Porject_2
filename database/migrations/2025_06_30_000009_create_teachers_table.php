<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('teachers', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('subject_id');
			$table->string('Academic_qualification', 50);
			$table->enum('Employment_status', array('active', 'suspended', 'resigned'));
			$table->enum('Payment_type', array('monthly', 'hourly'));
			$table->enum('Contract_type', array('permanent', 'temporary', 'part_time'));
			$table->date('The_beginning_of_the_contract');
			$table->date('End_of_contract');
			$table->tinyInteger('number_of_lesson_in_week');
			$table->tinyInteger('wages_per_lesson')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');


			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('teachers');
	}
};
