<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('staff_attendances', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('QR_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->enum('Attendance_status', array('present', 'absent', 'justified'));
			$table->text('nots')->nullable();
			$table->foreign('QR_id')->references('id')->on('qr_codes')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('staff_attendances');
	}
};
