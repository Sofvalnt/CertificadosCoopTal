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
        // Verifica si la tabla ya existe
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();
            });
        }

        // Añade las columnas solo si no existen
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'is_first_login')) {
                $table->boolean('is_first_login')
                    ->default(0)
                    ->comment('0 = debe cambiar contraseña, 1 = ya realizó el cambio');
            }

            if (!Schema::hasColumn('users', 'force_password_change')) {
                $table->boolean('force_password_change')
                    ->default(0)
                    ->comment('1 = cambio requerido por administrador');
            }

            if (!Schema::hasColumn('users', 'password_changed_at')) {
                $table->timestamp('password_changed_at')
                    ->nullable()
                    ->comment('Fecha del último cambio de contraseña');
            }

            if (!Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Añade índices si no existen
        Schema::table('users', function (Blueprint $table) {
            $indexes = Schema::getConnection()
                ->getDoctrineSchemaManager()
                ->listTableIndexes('users');

            if (!array_key_exists('users_is_first_login_index', $indexes)) {
                $table->index('is_first_login');
            }

            if (!array_key_exists('users_force_password_change_index', $indexes)) {
                $table->index('force_password_change');
            }
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        // No eliminamos la tabla completa para evitar pérdida de datos
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'is_first_login',
                'force_password_change',
                'password_changed_at'
            ]);
            $table->dropSoftDeletes();
        });
    }
};