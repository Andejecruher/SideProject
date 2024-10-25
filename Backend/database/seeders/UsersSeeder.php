<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
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
        // Create 10 fake users using the User factory
        User::factory(10)->create();
    }
}
