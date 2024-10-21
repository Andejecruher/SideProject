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
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('articles')->insert([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'content' => $faker->randomHtml(1, 1),
                'featured_image' => $faker->imageUrl(),
                'thumbnail' => $faker->imageUrl(),
                'publication_date' => $faker->dateTimeThisYear(),
                'category_id' => $faker->randomElement([1, 2, 3]), // Change the category IDs according to your database
                'user_id' => $faker->randomElement([1, 2, 3]), // Change the user IDs according to your database
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
