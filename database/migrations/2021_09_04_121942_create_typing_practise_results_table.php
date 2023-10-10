<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypingPractiseResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typing_practise_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->foreignId('typing_practise_id')->constrained()->onDelete('cascade');
            $table->foreignId('practise_type');
            $table->string('time');
            $table->string('tmark');
            $table->string('obtmark');
            $table->string('countmistake');
            $table->string('countlength')->nullable();
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
        Schema::dropIfExists('typing_practise_results');
    }
}
