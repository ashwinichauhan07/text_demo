<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePractisemcqsTable extends Migration
{
    public function up()
    {
        Schema::table('practisemcqs', function (Blueprint $table) {
            $table->string('que')->nullable()->change();
        });
        
    }

    public function down()
    {
        Schema::table('practisemcqs', function (Blueprint $table) {
            $table->string('que')->change();
        });
    }
}


