<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatement40testResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement40test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('typing_test_result_id')->constrained()
            ->onDelete('cascade');
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->string('headfig');
            $table->string('colheading');
            $table->string('alignment');
            $table->string('width');
            $table->string('borders');
            $table->string('questions');
            $table->string('marksform');
            $table->string('totmark');
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
        Schema::dropIfExists('statement40test_results');
    }
}
