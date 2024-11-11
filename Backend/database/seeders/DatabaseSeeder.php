<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * This method is used to seed the database with initial data.
     *
     * @return void
     */
    public function run()
    {
        // Call other seeders to seed additional tables
        $this->call([
            UserSeeder::class, // Seed the users table
            // UsersSeeder::class, // Seed the users table
            CategoriesTableSeeder::class, // Seed the categories table
            // ArticlesTableSeeder::class, // Seed the articles table
            // CommentsTableSeeder::class, // Seed the comments table
            TagsTableSeeder::class, // Seed the tags table
            // ArticleTagTableSeeder::class, // Seed the article_tag table
            RolePermissionSeeder::class, // Seed the roles and permissions
        ]);
    }
}
