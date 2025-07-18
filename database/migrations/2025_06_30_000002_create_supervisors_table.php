<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('supervisors', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->enum('status', array('active', 'on_leave', 'resigned'));
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('supervisors');
	}
};
