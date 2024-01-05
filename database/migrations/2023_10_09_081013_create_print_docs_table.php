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
            $table->date('scaf_print')->nullable();
            $table->date('sp3_print')->nullable();
            $table->date('siar_print')->nullable();
            $table->date('ssf_print')->nullable();
            $table->date('form8_print')->nullable();
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
