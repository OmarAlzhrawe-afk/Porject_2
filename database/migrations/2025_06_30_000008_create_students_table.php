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
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('Student_number', 50)->unique();
			$table->decimal('installment_total_amount')->nullable();
			$table->tinyInteger('installment_count')->nullable();
			$table->tinyInteger('installment_interval_days')->nullable();
			$table->enum('status', array('active', 'suspended', 'graduated', 'left'));
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('class_id')->references('id')->on('class_rooms')->onDelete('cascade');
			$table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('students');
	}
};
