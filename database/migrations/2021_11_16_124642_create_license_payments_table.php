<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('total_payment_id')->constrained()->onDelete('cascade');
            $table->foreignId('institute_id');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('subject_id');
            $table->string('amount');
            $table->string('amount_status')->comment('0 = pending, 1 = success, 2 = rejected');
            $table->string('added_by')->comment('added users user_id');
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
        Schema::dropIfExists('license_payments');
    }
}
