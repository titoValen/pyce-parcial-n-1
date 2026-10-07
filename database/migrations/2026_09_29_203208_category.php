<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea y elimina la tabla de categorías.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones
     */
    public function up(): void
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
