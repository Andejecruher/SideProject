<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method is used to seed the tags table with initial data.
     *
     * @return void
     */
    public function run()
    {
        //create instance for faker
        $faker = Faker::create();


        // Define an array of tags
        $tags = ['Tecnología', 'Desarrollo', 'Programación', 'Laravel', 'Vue.js', 'PHP', 'Base de Datos', 'Frontend', 'Backend'];

        // Insert each tag into the tags table
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag, // Name of the tag
                'color' => $faker->hexColor, // Generate a random hex color
                'created_at' => now(), // Set the current timestamp for created_at
                'updated_at' => now(), // Set the current timestamp for updated_at
            ]);
        }
    }
}
