<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('students', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('class_id');
			$table->string('Student_number', 50)->unique();
			$table->enum('status', array('active', 'suspended', 'graduated', 'left'));
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('class_id')->references('id')->on('class_rooms')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
};
