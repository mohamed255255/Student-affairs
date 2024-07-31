<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{

    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->string('student_name');
            $table->string('student_email')->unique(); // Unique email address
            $table->string('student_username')->unique(); // Unique username
            $table->string('student_phone');
            $table->date('student_birthdate'); // Birthdate in date format
            $table->text('student_address');
            $table->string('student_image')->nullable(); // Image path, can be null
            $table->string('student_password'); // Password (hashed)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
