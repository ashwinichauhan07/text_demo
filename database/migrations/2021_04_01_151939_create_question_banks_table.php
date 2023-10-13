<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->bigInteger('institute_id');
            $table->text("questionPaperName");
            $table->bigInteger("total_mcq_question");
            $table->integer("each_mcq_mark")->default(1);
            $table->integer("each_negative_mcq_mark")->default(0);
            $table->bigInteger("required_time");
            $table->text("question");
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
        Schema::dropIfExists('question_banks');
    }
}
