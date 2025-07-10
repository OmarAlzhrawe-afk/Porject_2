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
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name', 50);
            $table->string('email', 100);
            $table->string('password', 50)->nullable();
            $table->enum('role', array('admin', 'teacher', 'librarian', 'supervisor', 'student', 'parent'));
            $table->date('hire_date')->nullable();
            $table->longText('ID_documents')->nullable();
            $table->string('phone_number');
            // $table->string('verification_code')->nullable();
            // $table->datetime('verification_code')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('gender', array('male', 'female'))->nullable();
            $table->date('email_verified_at')->nullable();
            $table->text('address')->nullable();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('users');
    }
};
