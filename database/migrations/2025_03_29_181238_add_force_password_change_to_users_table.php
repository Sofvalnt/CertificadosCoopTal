<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Añade solo la columna force_password_change si no existe
            if (!Schema::hasColumn('users', 'force_password_change')) {
                $table->boolean('force_password_change')->default(false)
                    ->comment('Indica si se requiere cambio forzado de contraseña');
            }
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina solo las columnas que existen
            $columnsToDrop = ['force_password_change', 'is_first_login', 'password_changed_at'];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};