<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('pre_registrations', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('education_level_id')->unsigned();
			$table->string('student_name', 50);
			$table->string('student_email', 50);
			$table->string('parent_name', 50);
			$table->string('parent_email', 50);
			$table->string('phone_number', 50);
			$table->enum('status', array('pending', 'accepted', 'rejected'));
			$table->json('documents');
			$table->foreign('education_level_id')->references('id')->on('education_levels');

			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pre_registrations');
	}
};
