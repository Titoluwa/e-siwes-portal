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
            $table->foreignId('assigned_staff_id')->constrained('staff')->nullable();
            $table->foreignId('dept_coord')->constrained('staff')->nullable();
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
