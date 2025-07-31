<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('installment_plans', function (Blueprint $table) {
			$table->id();
			$table->string('name', 50);
			$table->decimal('total_amount');
			$table->tinyInteger('number_of_installments');
			$table->tinyInteger('count_of_days_per_each_installment');
			$table->text('description')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('installment_plans');
	}
};
