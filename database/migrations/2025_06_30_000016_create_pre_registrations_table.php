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
			$table->unsignedBigInteger('education_level_id');
			$table->unsignedBigInteger('installment_plan_id')->nullable();
			$table->string('payment_reference')->nullable();
			$table->boolean('payment_status')->default(false);
			$table->string('student_name', 50);
			$table->string('student_email', 50);
			$table->string('parent_name', 50);
			$table->string('parent_email', 50);
			$table->string('phone_number', 50);
			$table->enum('status', array('pending', 'accepted', 'rejected'))->default('pending');
			$table->longText('documents');
			$table->foreign('education_level_id')->references('id')->on('education_levels')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('installment_plan_id')->references('id')->on('installment_plans')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pre_registrations');
	}
};
