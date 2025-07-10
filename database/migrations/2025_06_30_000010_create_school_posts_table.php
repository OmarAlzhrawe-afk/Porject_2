<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('school_posts', function (Blueprint $table) {
			$table->id();
			$table->string('title', 255);
			$table->text('description')->nullable();
			$table->enum('post_type', array('lesson', 'news', 'event'));
			$table->string('file_url', 500)->nullable();
			$table->boolean('is_public');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('school_posts');
	}
};
