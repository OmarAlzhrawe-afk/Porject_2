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
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('payment_method_id')->unsigned();
			$table->decimal('amount');
			$table->enum('type', array('in', 'out'));
			$table->enum('transaction_source', array('salary', 'buy_book', 'register_user', 'activity'));
			$table->enum('status', array('pending', 'paid', 'failed'));
			$table->integer('installment_number')->nullable();
			$table->string('payment_reference');
			$table->boolean('is_installment');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('payment_method_id')->references('id')->on('payment_methods');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
};
