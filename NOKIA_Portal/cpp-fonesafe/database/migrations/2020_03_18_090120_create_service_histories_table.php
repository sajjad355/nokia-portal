<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->string('imei');
            $table->string('model');
            $table->string('price');
            $table->string('fs_code');
            $table->string('purchase_date');
            $table->integer('status');
            $table->timestamp('delivery_date')->nullable();
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
        Schema::dropIfExists('service_histories');
    }
}
