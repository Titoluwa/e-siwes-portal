<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupervisorToMonthlyRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monthly_records', function (Blueprint $table) {
            // $table->foreignId('staff_id')->constrained('staff')->nullable();
            // $table->foreignId('org_sup_id')->constrained('org_supervisors')->nullable();
            $table->integer('staff_id')->nullable();
            $table->integer('org_sup_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monthly_records', function (Blueprint $table) {
            $table->dropColumn('staff_id');
            $table->dropColumn('org_sup_id');
        });
    }
}
