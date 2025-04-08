<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // En la migración generada
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('force_password_change')->default(false);
    });
}
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['force_password_change', 'is_first_login', 'password_changed_at']);
        });
    }
};