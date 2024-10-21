<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticleTagTableSeeder extends Seeder
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

        // Define the range of article IDs
        $articles = range(1, 10); // Change the range according to the number of articles you have

        // Define the range of tag IDs
        $tags = range(1, 9); // Change the range according to the number of tags you have

        // Loop through each article ID
        foreach ($articles as $articleId) {
            // Determine the number of tags to assign to this article
            $numTags = $faker->numberBetween(1, 5); // Change the range according to the number of tags per article

            // Select random tags for this article
            $selectedTags = $faker->randomElements($tags, $numTags);

            // Loop through each selected tag ID
            foreach ($selectedTags as $tagId) {
                // Insert the article-tag relationship into the article_tag table
                DB::table('article_tag')->insert([
                    'article_id' => $articleId,
                    'tag_id' => $tagId,
                    'created_at' => now(), // Set the current timestamp for created_at
                    'updated_at' => now(), // Set the current timestamp for updated_at
                ]);
            }
        }
    }
}
