<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSwep200sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('swep200s', function (Blueprint $table) {
            $table->id();
            $table->integer('siwes_id')->nullable();
            $table->string('matric_number')->nullable();
            $table->integer('itcu_score')->nullable();
            $table->integer('dept_score')->nullable();
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
        Schema::dropIfExists('swep200s');
    }
}
