<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
	public function up()
	{
		Schema::create('payment_methods', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('payment_methods');
	}
};
