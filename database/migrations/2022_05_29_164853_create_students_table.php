<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            // $table->foreignId('org_id')->constrained('organizations')->nullable();
            // $table->integer('org_id')->nullable();
            $table->boolean('status')->default(1);
            $table->string('matric_no');
            $table->string('faculty');
            $table->string('department');
            $table->string('course_of_study');            
            // $table->year('year_of_training')->nullable();
            // $table->string('duration_of_training')->nullable();
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('students');
    }
}
