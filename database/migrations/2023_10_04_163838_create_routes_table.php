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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('travel_id');
            $table->unsignedBigInteger('user_id');
            
            $table->string('lat');
            $table->string('lon');
            
            $table->float('price')->nullable();
            $table->float('km')->nullable();

            $table->foreign('travel_id')
                ->references('id')
                ->on('travels')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('routes');
    }
};
