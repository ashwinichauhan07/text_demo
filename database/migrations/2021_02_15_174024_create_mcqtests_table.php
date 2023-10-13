<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcqtestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcqtests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->text('subject_id');
            $table->text('mcqtype_id');
            $table->string('timer');
            $table->string('que_mark');
            $table->string('criteria');
            $table->string('test_date');
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
        Schema::dropIfExists('mcqtests');
    }
}
