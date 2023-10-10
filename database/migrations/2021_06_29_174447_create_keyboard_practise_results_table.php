<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyboardPractiseResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyboard_practise_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('institute_id');
            $table->foreignId('subject_id');
            $table->foreignId('keboard_practice_id');
            $table->foreignId('practise_type');
            $table->bigInteger('correctWords');
            $table->bigInteger('acc');
            $table->bigInteger('incorrectWords');
            $table->string('timeminute');
            $table->bigInteger('speed');
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
        Schema::dropIfExists('keyboard_practise_results');
    }
}
