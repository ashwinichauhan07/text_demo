<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractisePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practise_papers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mcq_type_id');
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
        Schema::dropIfExists('practise_papers');
    }
}
