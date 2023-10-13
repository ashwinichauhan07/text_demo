<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('institute_id');
            $table->longText('que');
            $table->longText('hindique')->nullable();
            $table->longText('marathique')->nullable();
            // $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            // $table->foreignId('mcq_type_id');
            $table->boolean('is_mcq')->default(1);
            $table->longText('wright_ans');
            $table->longText('explanation');
            $table->longText('hindiwright_ans')->nullable();
            $table->longText('hindi_explanation')->nullable();
            $table->longText('marathiwright_ans')->nullable();
            $table->longText('marathi_explanation')->nullable();
            $table->bigInteger('view')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
