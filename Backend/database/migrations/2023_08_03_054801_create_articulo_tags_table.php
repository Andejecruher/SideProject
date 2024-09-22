<?php

// database/migrations/xxxx_xx_xx_create_articulo_tags_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArticuloTagsTable extends Migration
{
    public function up()
    {
        Schema::create('articulo_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('articulo_id')->constrained('articulos')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('articulo_tag');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

