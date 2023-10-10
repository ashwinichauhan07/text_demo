<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMcqTypeIdToPractiseExamsTable extends Migration
{
    public function up()
    {
        Schema::table('practise_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('mcq_type_id')->nullable();
            // Add any other necessary column definitions
        });
    }

    public function down()
    {
        Schema::table('practise_exams', function (Blueprint $table) {
            $table->dropColumn('mcq_type_id');
            // Drop any other columns if needed
        });
    }
}

