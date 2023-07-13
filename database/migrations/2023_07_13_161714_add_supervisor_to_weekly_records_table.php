<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupervisorToWeeklyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weekly_records', function (Blueprint $table) {
            $table->foreignId('org_sup_id')->constrained('org_supervisors')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_records', function (Blueprint $table) {
            $table->dropColumn('org_sup_id');
        });
    }
}
