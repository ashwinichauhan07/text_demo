<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeKeyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_key_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id');
            $table->bigInteger('institute_id');
            $table->bigInteger('language_id');
            $table->bigInteger('homekey_id');
            $table->bigInteger('speed');
            $table->bigInteger('wordsCount');
            $table->bigInteger('correctWords');
            $table->bigInteger('time');
            $table->bigInteger('acc');
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
        Schema::dropIfExists('home_key_results');
    }
}
