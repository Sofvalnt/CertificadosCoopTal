<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosDiplomasTable extends Migration
{
    public function up()
    {
        Schema::create('registros_diplomas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_generados');
            $table->string('curso')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registros_diplomas');
    }
}
