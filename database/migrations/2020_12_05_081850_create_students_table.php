<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('institute_id');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('lastname');
            $table->bigInteger('student_mob')->unique();
            $table->string('gender');
            $table->foreignId('handicap_id')->nullable();
            $table->string('created_id');
            $table->text('address');
            $table->text('school');
            $table->text('education');
            $table->foreignId('document_id');
            $table->text('otherdocument')->nullable();
            $table->bigInteger('identity_number');
            $table->string('dob');
            $table->string('doaddmission');
            $table->text('course_id');
            $table->text('subject_id');
            $table->string('student_type');
            $table->string('itiming_id');
            $table->string('coursefee_id');
            $table->string('isession_id');
            $table->bigInteger('year');
            $table->text('student_img');
            $table->text('identity_img');
            $table->boolean('status')->default(1);
            $table->string('currentmonth')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}
