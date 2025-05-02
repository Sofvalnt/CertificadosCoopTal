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
        // Verifica primero si la tabla existe
        if (Schema::hasTable('verificacions')) {
            Schema::table('verificacions', function (Blueprint $table) {
                // Añade nombre_estudiante solo si no existe
                if (!Schema::hasColumn('verificacions', 'nombre_estudiante')) {
                    $table->string('nombre_estudiante')
                        ->nullable()
                        ->after('id');
                }

                // Añade nombre_curso solo si no existe
                if (!Schema::hasColumn('verificacions', 'nombre_curso')) {
                    $table->string('nombre_curso')
                        ->nullable()
                        ->comment('Nombre del curso asociado');
                }
            });
        }
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        if (Schema::hasTable('verificacions')) {
            Schema::table('verificacions', function (Blueprint $table) {
                // Elimina las columnas solo si existen
                $columnsToDrop = ['nombre_estudiante', 'nombre_curso'];
                $existingColumns = Schema::getColumnListing('verificacions');
                
                $columnsToDrop = array_intersect($columnsToDrop, $existingColumns);
                
                if (!empty($columnsToDrop)) {
                    $table->dropColumn($columnsToDrop);
                }
            });
        }
    }
};