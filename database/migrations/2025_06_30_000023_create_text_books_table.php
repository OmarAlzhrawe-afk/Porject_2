<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('text_books', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('subject_id')->unsigned();
			$table->bigInteger('education_level_id')->unsigned();
			$table->string('title', 50);
			$table->integer('total_quantity');
			$table->integer('sold_quantity')->default('0');
			$table->integer('price');
			$table->integer('available_quantity');
			$table->foreign('subject_id')->references('id')->on('subjects');
			$table->foreign('education_level_id')->references('id')->on('education_levels');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('text_books');
	}
};
