<?php

// database/migrations/xxxx_xx_xx_create_articulos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateArticulosTable extends Migration
{
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('contenido');
            $table->string('imagen_destacada')->nullable();
            $table->timestamp('fecha_publicacion')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onDelete('set null');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });

    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::dropIfExists('articulos');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

