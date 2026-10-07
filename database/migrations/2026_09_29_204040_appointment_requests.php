<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Crea y elimina la tabla de solicitudes de turno.
 */
return new class extends Migration
{
    /**
     * Ejecuta las migraciones
     */
    public function up(): void
    {
        Schema::create('solicitudes_turno', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicio_id')->constrained('servicios')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('email');
            $table->string('telefono');
            $table->dateTime('fecha_tentativa');
            $table->text('mensaje')->nullable();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_turno');
    }
};
