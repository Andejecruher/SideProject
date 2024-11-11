<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is used to seed the users table with initial data.
     *
     * @return void
     */
    public function run()
    {

        // Insert a fake admin user into the users table
        DB::table("users")->insert([
            'first_name' => 'Administrador', // First name of the user
            'last_name' => 'Sistema', // Last name of the user
            'email' => 'admin@andejecruher.com', // Email of the user
            'password' => Hash::make('secret'), // Hashed password of the user
            'gender' => 'other', // Random gender
            'avatar' => '', // Fake avatar image
            'email_verified_at' => now(), // Email verification timestamp
            'address' => 'Calle Pavo Real #431', // Fake address
            'city' => 'Puerto Vallarta, Jalisco', // Fake city
            'postal_code' => '48280', // Fake postal code
            'role' => 'admin', // Role of the user
            'status' => 'active', // Status of the user
            'phone' => '3223018570', // Fake phone number
            'remember_token' => Str::random(10), // Random remember token
        ]);
    }
}
