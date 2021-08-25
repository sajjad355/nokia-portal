<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('store_id');
            $table->string('service_type');
            $table->string('imei');
            $table->string('brand')->nullable();
            $table->string('model');
            $table->string('price');
            $table->string('title');
            $table->string('gender')->nullable();
            $table->string('customer_name');
            $table->string('date_of_birth')->nullable();
            $table->string('mobile');
            $table->string('cpp_price');
            $table->string('emergency_contact')->nullable();
            $table->string('email')->nullable();
            $table->string('district');
            $table->string('address');
            $table->string('fs_code');
            $table->string('fs_mrp');
            $table->string('device_purchase_date')->nullable();
            $table->tinyInteger('is_verified')->nullable();
            $table->integer('verified_by')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
