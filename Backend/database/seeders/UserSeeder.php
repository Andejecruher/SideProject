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
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table("users")->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@volt.com',
            'password' => Hash::make('secret'),
            'gender' => Arr::random(['male', 'female', 'other']),
            'avatar' =>$faker->image('public/storage/avatars', 640,480, null, false),
            'email_verified_at' => now(),
            'address' => $faker->address,
            'city' => $faker->city,
            'postal_code' => $faker->randomNumber(6),
            'role' => 'admin',
            'status' => 'active',
            'phone' => $faker->buildingNumber,
            'remember_token' => Str::random(10),
        ]);
    }
}
