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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            
            // Campos para control de primer login y cambio de contraseña
            $table->boolean('is_first_login')->default(0)->comment('0=debe cambiar contraseña, 1=ya cambió');
            $table->boolean('force_password_change')->default(0)->comment('1=requiere cambio forzado');
            $table->timestamp('password_changed_at')->nullable()->comment('Fecha último cambio');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};