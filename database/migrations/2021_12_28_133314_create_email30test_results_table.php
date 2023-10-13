<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmail30testResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email30test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('typing_test_result_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->string('mailId');
            $table->string('mailSub');
            $table->string('mailBody');
            $table->string('mailSave');
            $table->string('mailAtt');
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
        Schema::dropIfExists('email30test_results');
    }
}
