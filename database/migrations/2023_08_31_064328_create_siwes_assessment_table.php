<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiwesAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siwes_assessment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siwes_id')->constrained('siwes');
            $table->foreignId('user_id')->constrained('users');
            $table->date('visitation_date');
            $table->boolean('available_at_visit');
            $table->string('why_not_available')->nullable();
            $table->boolean('logbook_seen');
            $table->boolean('logbook_completed');
            $table->boolean('logbook_appropriate');
            $table->string('why_not_appropriate')->nullable();
            $table->string('attitude_student');
            $table->string('challenges')->nullable();
            $table->string('qualitative');
            $table->integer('qualitative_score');
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
        Schema::dropIfExists('siwes_assessment');
    }
}
