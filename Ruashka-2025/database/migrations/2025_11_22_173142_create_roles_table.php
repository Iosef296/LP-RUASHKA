<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles2', function (Blueprint $table) {
            $table->id('Rol_ID');
            $table->string('Rol_Tipo');
            $table->string('Rol_Accesos', 50);
            $table->unsignedBigInteger('Trabajador_ID')->nullable(); // Temporal nullable
            $table->timestamps();
            
            // TODO: Agregar FK cuando exista la tabla trabajadores
            // $table->foreign('Trabajador_ID')->references('Trabajador_ID')->on('trabajadores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles2');
    }
};