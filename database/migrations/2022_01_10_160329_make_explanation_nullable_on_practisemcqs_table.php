<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeExplanationNullableOnPractisemcqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('practisemcqs', function (Blueprint $table) {

            $table->longText('explanation')->nullable()->change();
            $table->longText('explanation_marathi')->nullable()->change();
            $table->longText('explanation_hindi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practisemcqs', function (Blueprint $table) {

            $table->longText('explanation')->nullable(false)->change();
            $table->longText('explanation_marathi')->nullable(false)->change();
            $table->longText('explanation_hindi')->nullable(false)->change();
        });
    }
}
