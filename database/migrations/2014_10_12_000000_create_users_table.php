<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->integer('role_id')->default(0);
            $table->integer('status_id')->default(1);            
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->default(null);
            $table->integer('contact_no');
            $table->string('matric_no')->unique()->default(null);
            $table->string('staff_id')->default(null);
            $table->string('gender');
            $table->string('faculty')->default(null);
            $table->string('department');
            $table->string('course_of_study')->default(null);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
