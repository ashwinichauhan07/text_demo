<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentIdToPractiseExamsTable extends Migration
{
    public function up()
    {
        Schema::table('practise_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->nullable();
            // Add any other necessary column definitions
        });
    }

    public function down()
    {
        Schema::table('practise_exams', function (Blueprint $table) {
            $table->dropColumn('student_id');
            // Drop any other columns if needed
        });
    }
}

