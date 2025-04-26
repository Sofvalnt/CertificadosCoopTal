<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('verificacions', function (Blueprint $table) {
            $table->string('nombre_estudiante')
                ->nullable()
                ->after('id'); // Opcional: define posición de la columna
            
            $table->string('nombre_curso')
                ->nullable()
                ->comment('Nombre del curso asociado'); // Opcional: añade comentario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verificacions', function (Blueprint $table) {
            $table->dropColumn([
                'nombre_estudiante',
                'nombre_curso'
            ]);
        });
    }
};