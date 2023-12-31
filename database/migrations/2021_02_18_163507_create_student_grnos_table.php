<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGrnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_grnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('student_type');
            $table->string('student_grno');
            $table->string('doaddmission');
            $table->string('isession_id');
            $table->string('year');
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
        Schema::dropIfExists('student_grnos');
    }
}
