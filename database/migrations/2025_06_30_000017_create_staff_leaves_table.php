<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('staff_leaves', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->date('leave_date');
			$table->enum('period', ['day', '3day', 'week', '2week', 'month', 'year']);
			$table->enum('leave_type', array('sick', 'personal', 'unpaid', 'emergency'));
			$table->enum('status', array('pending', 'approved', 'rejected'));
			$table->text('notes')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('staff_leaves');
	}
};
