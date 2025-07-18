<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up()
	{
		Schema::create('education_levels', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->text('description');
			$table->foreignId('supervisor_id')->constrained('supervisors')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('education_levels');
	}
};
