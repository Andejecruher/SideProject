<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is used to seed the categories table with fake data.
     *
     * @return void
     */
    public function run()
    {
        // Create a Faker instance
        $faker = Faker::create();

        // Insert 10 fake categories into the categories table
        foreach (range(1, 10) as $index) {
            DB::table('categories')->insert([
                'name' => $faker->word, // Generate a fake name
                'description' => $faker->sentence, // Generate a fake description
                'icon' => $faker->randomElement(['fas fa-laptop', 'fas fa-code', 'fas fa-database', 'fas fa-server', 'fas fa-mobile-alt']), // Assign a random icon
                'color' => $faker->hexColor, // Generate a random hex color
                'created_at' => now(), // Set the current timestamp for created_at
                'updated_at' => now(), // Set the current timestamp for updated_at
            ]);
        }
    }
}
