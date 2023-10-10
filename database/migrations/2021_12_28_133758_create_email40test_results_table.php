<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmail40testResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email40test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('typing_test_result_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->string('EmailSend');
            $table->string('EmailTo');
            $table->string('EmailCc');
            $table->string('EmailBcc');
            $table->string('EmailSubject');
            $table->string('EmailBody');
            $table->string('EmailAtt1');
            $table->string('EmailAtt2');
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
        Schema::dropIfExists('email40test_results');
    }
}
