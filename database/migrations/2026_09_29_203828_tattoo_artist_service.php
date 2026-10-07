<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea y elimina la tabla intermedia de tatuadores y servicios.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones
     */
    public function up(): void
    {
        Schema::create('servicio_tatuador', function (Blueprint $table) {
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->foreignId('tatuador_id')->constrained('tatuadores')->cascadeOnDelete();
            $table->primary(['servicio_id', 'tatuador_id']);
        });
    }

    /**
     * Revierte las migraciones
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_tatuador');
    }
};
