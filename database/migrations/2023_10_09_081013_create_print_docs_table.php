<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_docs', function (Blueprint $table) {
            $table->id();
            $table->integer('siwes_id');
            $table->boolean('scaf')->default(0);
            $table->boolean('sp3')->default(0);
            $table->boolean('siar')->default(0);
            $table->boolean('ssf')->default(0);
            $table->boolean('form8')->default(0);
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
        Schema::dropIfExists('print_docs');
    }
}
