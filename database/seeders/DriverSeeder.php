<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Driver::firstOrCreate(
            [
                'username' => 'driver',
            ],
            [
                'first_name' => 'Driver',
                'last_name' => 'Driverow',
                'car_number' => 'BT 44 52 AG',
                'car_model' => 'Toyota Camry',
                'birthday' => '1998-10-04',
                'start_working' => '2023-09-22 10:23:00',
                'password' => Hash::make('password'),
                'status' => true,
            ]
        );
    }
}
