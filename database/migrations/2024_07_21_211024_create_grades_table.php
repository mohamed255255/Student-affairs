<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->decimal('course_work');
            $table->decimal('final_work');
            $table->string('grade');
            $table->foreignId('student_id')->constrained();
            $table->foreignId('course_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
};




