<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFscodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fscodes', function (Blueprint $table) {
            $table->id();
            $table->string('fscode');
            $table->string('tier');
            $table->integer('status');
            $table->string('sale_date');
            $table->integer('sale_by');
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
        Schema::dropIfExists('fscodes');
    }
}
