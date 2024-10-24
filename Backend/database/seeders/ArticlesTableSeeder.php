<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a Faker instance
        $faker = Faker::create();

        // Insert 10 fake articles into the articles table
        foreach (range(1, 10) as $index) {
            DB::table('articles')->insert([
                'title' => $faker->sentence, // Generate a fake title
                'description' => $faker->paragraph, // Generate a fake description
                'content' => $faker->randomHtml(), // Generate fake HTML content
                'featured_image' => $faker->image('public/storage/featured_image', 640, 480, 'avatar', false), // Generate a fake featured image
                'thumbnail' => $faker->image('public/storage/thumbnail', 320, 280, 'article', false), // Generate a fake thumbnail image
                'publication_date' => null, // Generate a fake publication date within this year
                'published' => false, // Set the published status to false
                'category_id' => $faker->randomElement([1, 2, 3]), // Assign a random category ID (change according to your database)
                'user_id' => $faker->randomElement([1, 2, 3]), // Assign a random user ID (change according to your database)
                'created_at' => now(), // Set the current timestamp for created_at
                'updated_at' => now(), // Set the current timestamp for updated_at
            ]);
        }
    }
}
