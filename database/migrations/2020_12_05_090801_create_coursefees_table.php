<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursefeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coursefees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->string('course_id');
            $table->string('subject_id');
            $table->string('student_type');
            $table->string('fees');
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
        Schema::dropIfExists('coursefees');
    }
}
