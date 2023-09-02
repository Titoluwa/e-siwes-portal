<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiwesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siwes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('sessions');
            $table->foreignId('siwes_type_id')->constrained('siwes_type');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('assigned_staff_id')->nullable();
            $table->integer('dept_coord')->nullable();
            $table->integer('org_id')->nullable();
            $table->year('year_of_training')->nullable();
            $table->string('duration_of_training')->nullable();
            $table->date('resumption_date')->nullable();
            $table->date('ending_date')->nullable();
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
        Schema::dropIfExists('siwes');
    }
}
