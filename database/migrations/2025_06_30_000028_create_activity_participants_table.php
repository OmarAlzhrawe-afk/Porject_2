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
        Schema::create('activity_participants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('activity_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->enum('payment_status', array('pending', 'paid', 'cancelled', 'free_activity'));
            $table->boolean('attendance')->default(false);
            $table->enum('payment_method', array('cash', 'by_parent', 'by_app'))->nullable();
            $table->text('notes')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('student_id')->references('id')->on('students');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_participants');
    }
};
