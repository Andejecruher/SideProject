<?php

// database/migrations/xxxx_xx_xx_create_articles_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is used to create the 'articles' table in the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the article
            $table->text('description'); // Description of the article
            $table->text('content'); // Content of the article
            $table->string('featured_image')->nullable(); // Featured image of the article, nullable
            $table->string('thumbnail')->nullable(); // Thumbnail image of the article, nullable
            $table->boolean('published')->default(false); // Published status of the article, default is false
            $table->timestamp('publication_date')->nullable(); // Publication date of the article, nullable
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key to the categories table, nullable
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null'); // Foreign key constraint, set to null on delete
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete(); // Foreign key to the users table, set to null on delete
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is used to drop the 'articles' table from the database.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0'); // Disable foreign key checks
        Schema::dropIfExists('articles'); // Drop the articles table
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); // Enable foreign key checks
    }
}
