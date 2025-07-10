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
			$table->string('Unique_code', 255)->unique();
			$table->enum('Code_type', array('teacher', 'employee'));
			$table->char('Class_Name')->nullable();
			$table->boolean('is_Active')->default(true);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('qr_codes');
	}
};
