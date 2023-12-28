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
            
            $table->string('first_name');
            $table->string('last_name');
            
            $table->string('car_number');
            $table->string('car_model');
            
            $table->string('birthday');
            $table->string('start_working');

            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('status');
            $table->boolean('online')->default(0);
            $table->string('time')->default(0);

            $table->text('device_token')->nullable(); // Add device token in users migration file
            
            $table->rememberToken();
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
