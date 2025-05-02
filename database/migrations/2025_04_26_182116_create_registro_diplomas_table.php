<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        // Verifica si la tabla no existe antes de crearla
        if (!Schema::hasTable('registro_diplomas')) {
            Schema::create('registro_diplomas', function (Blueprint $table) {
                $table->id();
                $table->string('curso')
                    ->index()  // Añade índice para búsquedas más rápidas
                    ->comment('Nombre del curso o programa');
                
                $table->integer('cantidad_generados')
                    ->default(0)
                    ->comment('Número de diplomas generados para este curso');
                
                // Campos de auditoría
                $table->timestamps();
                $table->softDeletes(); // Para eliminación lógica
                
                // Índices adicionales
                $table->index('created_at'); // Para consultas por fecha
            });
        }
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        // Elimina la tabla solo si existe
        Schema::dropIfExists('registro_diplomas');
    }
};