<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLetter30testResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter30test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('typing_test_result_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->string('head');
            $table->string('reference');
            $table->string('add');
            $table->string('sub');
            $table->string('salute');
            $table->string('paragraph');
            $table->string('close');
            $table->string('enclosure');
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
        Schema::dropIfExists('letter30test_results');
    }
}
