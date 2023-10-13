<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_papers', function (Blueprint $table) {
            $table->id();
        $table->foreignId('m_c_q_practise_exam_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id');
            $table->foreignId('question_id');
            $table->foreignId('answer_id')->nullable();
            $table->text('ans')->nullable();
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
        Schema::dropIfExists('test_papers');
    }
}
