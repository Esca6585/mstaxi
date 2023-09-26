<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::firstOrCreate(
            [
                'username' => 'admin',
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Adminow',
                'password' => Hash::make('password'),
            ]
        );
    }
}
