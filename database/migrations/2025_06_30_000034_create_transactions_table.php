<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->enum('payment_method', array('cash', 'visa', 'Transfer(shamcash)'));
			$table->decimal('amount');
			$table->enum('type', array('in', 'out'));
			// Done buy_book
			$table->enum('transaction_source', array('pay_salary', 'buy_book', 'pre_registration', 'installment_student', 'Enroll_activity'));
			$table->enum('status', array('pending', 'paid', 'failed'));
			$table->integer('installment_number')->nullable();
			$table->string('payment_reference')->nullable();
			$table->boolean('is_installment');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
};
