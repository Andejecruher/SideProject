<?php

// database/migrations/xxxx_xx_xx_create_article_tags_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade'); // Foreign key to the articles table, cascade on delete
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade'); // Foreign key to the tags table, cascade on delete
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0'); // Disable foreign key checks
        Schema::dropIfExists('article_tag'); // Drop the article_tag table
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); // Enable foreign key checks
    }
}
