<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSiwesTypeToDailyRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('daily_records', function (Blueprint $table) {
            $table->integer('siwes_id')->nullable();
            // $table->integer('session_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_records', function (Blueprint $table) {
            $table->dropColumn('siwes_id');
            // $table->dropColumn('session_id');
        });
    }
}
