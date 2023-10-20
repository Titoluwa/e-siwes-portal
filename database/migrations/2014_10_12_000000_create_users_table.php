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
            $table->boolean('status')->default(1);
            $table->string('email')->unique();            
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->bigInteger('contact_no');       
            $table->string('profile_pic')->nullable();          
            $table->string('gender')->nullable();
            $table->string('signature')->nullable();
            $table->string('password');
            $table->boolean('logged')->default(0);
            $table->timestamp('last_login')->nullable();
            $table->string('verified_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
