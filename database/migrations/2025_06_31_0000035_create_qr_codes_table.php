<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('qr_codes', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('class_id')->nullable();
			$table->unsignedBigInteger('user_id')->nullable();
			$table->timestamp('expires_at')->nullable();
			$table->string('Unique_code', 255)->unique();
			$table->enum('Code_type', array('teacher', 'employee'));
			$table->boolean('is_Active')->default(true);
			$table->foreign('class_id')->references('id')->on('class_rooms')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('qr_codes');
	}
};
