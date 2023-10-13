<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructorpayments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('amount');
            $table->integer('mode')->comment('1 = cash,2 = other');
            $table->string('cheque_number')->nullable();
            $table->date('cheque_date')->nullable();
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
        Schema::dropIfExists('instructorpayments');
    }
}
