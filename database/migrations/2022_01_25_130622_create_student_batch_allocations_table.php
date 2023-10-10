<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBatchAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_batch_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->foreignId('exambatches_id');
            $table->foreignId('batch_name');
            $table->foreignId('exam_name');
            $table->foreignId('subject_id');
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
        Schema::dropIfExists('student_batch_allocations');
    }
}
