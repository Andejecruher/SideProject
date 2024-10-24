<?php
// database/migrations/xxxx_xx_xx_create_tags_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->unique(); // Name of the tag, unique
            $table->string('color'); // Color of the tag
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
        Schema::dropIfExists('tags'); // Drop the tags table
        DB::statement('SET FOREIGN_KEY_CHECKS=1'); // Enable foreign key checks
    }
}
