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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('doctor_name');
            $table->string('description');
            $table->string('pre_requisites');
            $table->string('max_students');
            $table->timestamps();
        });
    }


    public function down()
    {
    }
};
