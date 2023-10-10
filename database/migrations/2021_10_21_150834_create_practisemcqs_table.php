<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePractisemcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practisemcqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('institute_id')->nullable();
            $table->longText('que');
            $table->longText('quemarathi')->nullable();
            $table->longText('quehindi')->nullable();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('mcq_type_id');
            $table->boolean('is_mcq')->default(1);
            $table->longText('wright_ans');
            $table->longText('explanation');
            $table->longText('marathiwright_ans')->nullable();
            $table->longText('explanation_marathi')->nullable();
            $table->longText('hindiwright_ans')->nullable();
            $table->longText('explanation_hindi')->nullable();
            $table->bigInteger('view')->nullable();
            // $table->string('que_file')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->dropColumn('filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practisemcqs');
    }
}
