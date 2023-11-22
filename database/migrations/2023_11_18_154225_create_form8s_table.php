<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForm8sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form8s', function (Blueprint $table) {
            $table->id();
            $table->integer('siwes_id');
            $table->text('depts_at_org')->nullable();
            $table->string('total_allowance')->nullable();
            $table->text('experience_outline')->nullable();
            $table->string('previous_attachment')->nullable();
            $table->string('weeks_engaged')->nullable();
            $table->date('student_filled')->nullable();

            $table->boolean('employer_agree_3')->nullable();
            $table->integer('employer_total_allowance')->nullable();
            $table->string('employer_assessment')->nullable();
            $table->string('accept_student')->nullable();
            $table->string('future_position')->nullable();
            $table->string('employer_rank')->nullable();
            $table->date('employer_filled')->nullable();

            $table->integer('no_of_visits')->nullable();
            $table->string('assess_facilties')->nullable();
            $table->string('student_impression')->nullable();
            $table->string('assess_student_grade')->nullable();
            $table->string('staff_rank')->nullable();
            $table->date('staff_filled')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('form8s');
    }
}
