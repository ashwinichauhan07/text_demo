<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatement30testResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement30test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('typing_test_result_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->string('head');
            $table->string('columnhead');
            $table->string('celalign');
            $table->string('colwidth');
            $table->string('border');
            $table->string('former');
            $table->string('total');
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
        Schema::dropIfExists('statement30test_results');
    }
}
