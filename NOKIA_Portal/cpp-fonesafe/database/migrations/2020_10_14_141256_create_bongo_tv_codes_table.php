<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBongoTvCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bongo_tv_codes', function (Blueprint $table) {
            $table->id();
            $table->string('bongo_tv_code');
            $table->tinyInteger('status');
            $table->string('use_date')->nullable();
            $table->string('imei')->nullable();
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
        Schema::dropIfExists('bongo_tv_codes');
    }
}
