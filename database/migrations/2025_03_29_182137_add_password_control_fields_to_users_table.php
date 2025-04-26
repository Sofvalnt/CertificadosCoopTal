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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'force_password_change')) {
                $table->boolean('force_password_change')
                    ->default(false)
                    ->after('password')
                    ->comment('Indica si el usuario debe cambiar su contraseña en el próximo login');
            }

            if (!Schema::hasColumn('users', 'is_first_login')) {
                $table->boolean('is_first_login')
                    ->default(true)
                    ->after('force_password_change')
                    ->comment('Indica si es el primer inicio de sesión del usuario');
            }

            if (!Schema::hasColumn('users', 'password_changed_at')) {
                $table->timestamp('password_changed_at')
                    ->nullable()
                    ->after('is_first_login')
                    ->comment('Fecha del último cambio de contraseña');
            }
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'force_password_change')) {
                $table->dropColumn('force_password_change');
            }

            if (Schema::hasColumn('users', 'is_first_login')) {
                $table->dropColumn('is_first_login');
            }

            if (Schema::hasColumn('users', 'password_changed_at')) {
                $table->dropColumn('password_changed_at');
            }
        });
    }
};
