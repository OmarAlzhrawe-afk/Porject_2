<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('public_contents', function (Blueprint $table) {
			$table->id();
			$table->enum('content_type', array('about', 'vision', 'Frequently_asked_questions'));
			$table->longText('content');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('public_contents');
	}
};
