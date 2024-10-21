<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Faker\Factory as Faker;

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
        // Create a Faker instance
        $faker = Faker::create();

        // Insert a fake admin user into the users table
        DB::table("users")->insert([
            'first_name' => 'Admin', // First name of the user
            'last_name' => 'User', // Last name of the user
            'email' => 'admin@volt.com', // Email of the user
            'password' => Hash::make('secret'), // Hashed password of the user
            'gender' => Arr::random(['male', 'female', 'other']), // Random gender
            'avatar' => $faker->image('public/storage/avatars', 640, 480, null, false), // Fake avatar image
            'email_verified_at' => now(), // Email verification timestamp
            'address' => $faker->address, // Fake address
            'city' => $faker->city, // Fake city
            'postal_code' => $faker->randomNumber(6), // Fake postal code
            'role' => 'admin', // Role of the user
            'status' => 'active', // Status of the user
            'phone' => $faker->buildingNumber, // Fake phone number
            'remember_token' => Str::random(10), // Random remember token
        ]);
    }
}
