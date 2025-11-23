<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyeccion', function (Blueprint $table) {
            $table->id('Proyec_ID');
            $table->string('Proyec_Nombre', 50);
            $table->string('Proyec_Descripcion', 100);
            $table->string('Proyec_tipo', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyeccion');
    }
};