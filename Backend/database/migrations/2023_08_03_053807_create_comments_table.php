<?php
// database/migrations/xxxx_xx_xx_create_comments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->text('content'); // Content of the comment
            $table->string('author_name')->nullable(); // Name of the author, nullable
            $table->string('author_email')->nullable(); // Email of the author, nullable
            $table->date('published_at')->nullable(); // Date of publication, nullable
            $table->string('ip_address')->nullable(); // IP address of the author, nullable
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade'); // Foreign key to the articles table, cascade on delete
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
        Schema::dropIfExists('comments'); // Drop the comments table
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); // Enable foreign key checks
    }
}
