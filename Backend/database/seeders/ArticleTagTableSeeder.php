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
        $faker = Faker::create();

        $articles = range(1, 10); // Change the range according to the number of articles you have
        $tags = range(1, 9); // Change the range according to the number of tags you have

        foreach ($articles as $articleId) {
            $numTags = $faker->numberBetween(1, 5); // Change the range according to the number of tags per article
            $selectedTags = $faker->randomElements($tags, $numTags);

            foreach ($selectedTags as $tagId) {
                DB::table('article_tag')->insert([
                    'article_id' => $articleId,
                    'tag_id' => $tagId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
