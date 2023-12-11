<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id();
            $table->string('name_tm');
            $table->string('name_ru');
            $table->integer('minimum_price');
            $table->integer('every_minute_price');
            $table->integer('every_km_price');
            $table->integer('every_waiting_price');
            $table->integer('free_waiting_minute');
            $table->integer('every_minute_price_outside');
            $table->integer('every_km_price_outside');
            $table->boolean('additional_tarif')->default(false);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('tarifs');
    }
}
