<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentinstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentinstallments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id');
            $table->string('created_id');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('amount');
            $table->integer('mode')->comment('1 = cash,2 = other');
            $table->string('check_number')->nullable();
            $table->integer('type')->comment('1 = credit,2 = debit');
            $table->date('check_date')->nullable();
            $table->date('next_installmentdate')->nullable();
            $table->string('totalpaid_amount')->nullable();
            $table->string('balance_amount')->nullable();
            $table->string('currentmonth')->nullable();
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
        Schema::dropIfExists('studentinstallments');
    }
}
