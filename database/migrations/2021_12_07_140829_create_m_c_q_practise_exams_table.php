<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCQPractiseExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_c_q_practise_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('institute_id');
            $table->bigInteger('question_bank_no');
            $table->string('name');
            $table->string('code');
            $table->longText('instruction');
            $table->dateTime('startExam');
            $table->dateTime('endExam');
            $table->time('duration');
            $table->time('instruction_time');
            $table->integer('pass_percentage');
            $table->integer('result')->comment('1 = show result,0 = not show result.');
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
        Schema::dropIfExists('m_c_q_practise_exams');
    }
}
