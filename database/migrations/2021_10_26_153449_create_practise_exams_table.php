<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractiseExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practise_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('institute_id');
            $table->bigInteger('question_bank_no');
            $table->string('name');
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
        Schema::dropIfExists('practise_exams');
    }
}
