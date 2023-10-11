<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siwes_id')->constrained('siwes');
            $table->integer('student_id');
            $table->integer('supervisor_id');
            $table->string('qualitative')->nullable();
            $table->integer('qualitative_score')->default(0);
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
        Schema::dropIfExists('org_assessments');
    }
}
