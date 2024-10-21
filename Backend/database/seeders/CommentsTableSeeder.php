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
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('comments')->insert([
                'content' => $faker->paragraph,
                'author_name' => $faker->name,
                'article_id' => $faker->numberBetween(1, 10), // Change according to your database
                'user_id' => $faker->randomElement([1, 2, 3, null]), // Change according to your database
                'ip_address' => $faker->ipv4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
