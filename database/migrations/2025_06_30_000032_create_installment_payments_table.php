<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('installment_payments', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('student_id')->unsigned();
			$table->bigInteger('installment_plan_id')->unsigned();
			$table->date('due_date');
			$table->decimal('amount');
			$table->boolean('paid')->default(false);
			$table->date('payment_date')->nullable();
			$table->foreign('student_id')->references('id')->on('students');
			$table->foreign('installment_plan_id')->references('id')->on('installment_plans');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installment_payments');
	}
};
