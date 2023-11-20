<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('tarif_id');
            
            $table->float('price')->nullable();
            $table->float('km')->nullable();
            
            $table->string('lat');
            $table->string('lon');

            $table->string('lat_finish')->nullable();
            $table->string('lon_finish')->nullable();
            
            $table->string('time_of_waiting')->nullable();

            $table->string('status')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('tarif_id')
                ->references('id')
                ->on('tarifs')
                ->onDelete('cascade');

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
        Schema::dropIfExists('travels');
    }
};
