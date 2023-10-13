<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halltickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('subject_id');
            $table->string('exam_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('day');
            $table->string('batch');
            // $table->string('center_name');
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
        Schema::dropIfExists('halltickets');
    }
}
