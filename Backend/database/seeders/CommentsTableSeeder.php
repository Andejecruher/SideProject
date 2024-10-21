<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is used to seed the comments table with fake data.
     *
     * @return void
     */
    public function run()
    {
        // Create a Faker instance
        $faker = Faker::create();

        // Insert 20 fake comments into the comments table
        foreach (range(1, 20) as $index) {
            DB::table('comments')->insert([
                'content' => $faker->paragraph, // Generate a fake paragraph for the comment content
                'author_name' => $faker->name, // Generate a fake name for the author
                'article_id' => $faker->numberBetween(1, 10), // Assign a random article ID (change according to your database)
                'user_id' => $faker->randomElement([1, 2, 3, null]), // Assign a random user ID or null (change according to your database)
                'ip_address' => $faker->ipv4, // Generate a fake IPv4 address
                'created_at' => now(), // Set the current timestamp for created_at
                'updated_at' => now(), // Set the current timestamp for updated_at
            ]);
        }
    }
}
