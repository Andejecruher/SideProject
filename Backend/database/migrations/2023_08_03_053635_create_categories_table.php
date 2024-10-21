<?php

// database/migrations/xxxx_xx_xx_create_categories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is used to create the 'categories' table in the database.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the category
            $table->text('description')->nullable(); // Description of the category, nullable
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is used to drop the 'categories' table from the database.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
