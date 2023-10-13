<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstitutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('principle_name');
            $table->bigInteger('principle_mob')->unique();
            $table->string('principle_email')->unique();
            $table->text('address');
            $table->string('course_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->Integer('pc');
            $table->Integer('institute_code');
            $table->string('inst_logo')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('institutes');
    }
}
