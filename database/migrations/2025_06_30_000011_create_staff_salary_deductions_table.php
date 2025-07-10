<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('staff_salary_deductions', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			//$table->enum('user_type', array('teacher', 'supervisor', 'librarian'));
			$table->integer('amount')->default('0');
			$table->text('reason');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('staff_salary_deductions');
	}
};
