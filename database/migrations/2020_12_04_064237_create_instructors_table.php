<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('institute_id');
            $table->foreignId('inst_id');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('phone_no')->unique();
            $table->string('gender');
            $table->text('address');
            $table->string('stream');
            $table->string('university');
            $table->string('passingyear');
            $table->string('percent');
            $table->string('grade');
            $table->string('identity_img')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}
