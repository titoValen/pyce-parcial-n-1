<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea y elimina la tabla de servicios.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones
     */
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->decimal('precio_base', 10, 2);
            $table->time('duracion_estimada');
            $table->string('estilo');
            $table->string('imagen')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
