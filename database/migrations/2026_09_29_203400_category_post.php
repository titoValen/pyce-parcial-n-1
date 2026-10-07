<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea y elimina la tabla intermedia de publicaciones y categorías.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones
     */
    public function up(): void
    {
        Schema::create('categoria_post', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete();
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->primary(['post_id', 'categoria_id']);
        });
    }

    /**
     * Revierte las migraciones
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_post');
    }
};
