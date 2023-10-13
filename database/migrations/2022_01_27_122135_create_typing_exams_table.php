<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypingExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typing_exams', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('institute_id');
            $table->string('subject_id');
            $table->string('batch_name');
            $table->string('exam_name');
            $table->text('practise_type');
            $table->bigInteger('exam_time');
            $table->bigInteger('exam_mark');
            $table->text('typingdata');
            $table->string('key');
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
        Schema::dropIfExists('typing_exams');
    }
}
