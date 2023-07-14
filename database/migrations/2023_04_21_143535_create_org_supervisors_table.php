<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->foreignId('user_id')->constrained('users');
            // $table->foreignId('org_id')->constrained('organizations')->nullable();
            $table->foreignId('org_id')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('org_supervisors');
    }
}
