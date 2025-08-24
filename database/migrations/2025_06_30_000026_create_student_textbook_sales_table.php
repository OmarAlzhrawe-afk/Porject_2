<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('student_textbook_sales', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('student_id')->unsigned()->nullable();
			$table->bigInteger('textbook_id')->unsigned()->nullable();
			$table->date('sale_date');
			$table->integer('quantity');
			$table->integer('total_price');
			$table->foreign('student_id')->references('id')->on('students')->onDelete('set null')->onUpdate('cascade');
			$table->foreign('textbook_id')->references('id')->on('text_books')->onDelete('set null')->onUpdate('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('student_textbook_sales');
	}
};
