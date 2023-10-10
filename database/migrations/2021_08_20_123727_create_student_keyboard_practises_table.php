<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentKeyboardPractisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_keyboard_practises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->foreignId('keboard_practice_id');
            $table->foreignId('student_id');
            $table->foreignId('subject_id');
            $table->foreignId('practise_type');
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
        Schema::dropIfExists('student_keyboard_practises');
    }
}
