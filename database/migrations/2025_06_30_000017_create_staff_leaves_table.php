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
			$table->bigInteger('user_id')->unsigned();
			$table->date('start_date');
			$table->date('End_date');
			$table->enum('leave_type', array('sick', 'personal', 'unpaid', 'emergency'));
			$table->enum('status', array('pending', 'approved', 'rejected'));
			$table->text('notes')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('staff_leaves');
	}
};
