<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('users');
            $table->string('name');
            $table->string('full_address');
            $table->string('postal_address');
            $table->date('year_of_est');
            $table->string('nature');
            $table->string('specialization');
            $table->string('plant_capacity')->nullable();
            $table->string('other_info')->nullable();
            $table->string('logo');
            $table->integer('status_id')->default(0);
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
        Schema::dropIfExists('organizations');
    }
}
