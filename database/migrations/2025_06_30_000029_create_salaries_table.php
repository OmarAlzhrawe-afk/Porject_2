<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('salaries', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('user_id')->unsigned();
			$table->decimal('Base_salary');
			$table->decimal('bonus')->nullable();
			$table->decimal('deductions')->nullable();
			$table->decimal('net_salary');
			$table->date('pay_date');
			$table->enum('status', array('paid', 'pending'));
			$table->text('notes')->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('salaries');
	}
};
