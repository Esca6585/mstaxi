<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [
                'username' => 'driver',
            ],
            [
                'first_name' => 'Driver',
                'last_name' => 'Driverow',
                'car_number' => 'BT 44 52 AG',
                'car_model' => 'Toyota Camry',
                'birthday' => '1998-10-04',
                'start_working' => '2023-07-10 09:00:00',
                'password' => Hash::make('password'),
                'status' => true,
            ]
        );

        User::firstOrCreate(
            [
                'username' => 'esen',
            ],
            [
                'first_name' => 'Esen',
                'last_name' => 'Meredow',
                'car_number' => 'BT 65 85 AG',
                'car_model' => 'Toyota Camry',
                'birthday' => '1998-10-04',
                'start_working' => '2023-10-30 09:00:00',
                'password' => Hash::make('password'),
                'status' => true,
            ]
        );
        
        User::firstOrCreate(
            [
                'username' => 'dowran2106',
            ],
            [
                'first_name' => 'Dowran',
                'last_name' => 'Jumakulyyew',
                'car_number' => 'AT 65 28 AG',
                'car_model' => 'Toyota Fortunner',
                'birthday' => '1999-21-06',
                'start_working' => '2023-08-22 09:00:00',
                'password' => Hash::make('password'),
                'status' => true,
            ]
        );

        User::firstOrCreate(
            [
                'username' => 'dowran',
            ],
            [
                'first_name' => 'Dowran',
                'last_name' => 'Şiriýew',
                'car_number' => 'AB 12 34 AH',
                'car_model' => 'Toyota Corolla',
                'birthday' => '1994-11-09',
                'start_working' => '2023-08-22 09:00:00',
                'password' => Hash::make('password'),
                'status' => true,
            ]
        );

        User::firstOrCreate(
            [
                'username' => 'eziz',
            ],
            [
                'first_name' => 'Eziz',
                'last_name' => 'Rejepgeldiyew',
                'car_number' => 'DA 20 03 MR',
                'car_model' => 'Toyota Camry',
                'birthday' => '2003-17-02',
                'start_working' => '2023-10-22 10:23:00',
                'password' => Hash::make('password'),
                'status' => true,
            ]
        );
    }
}
