<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id('Proveedor_ID');
            $table->string('Proveedor_Nombre');
            $table->string('Proveedor_RUC', 30);
            $table->string('Proveedor_Rubro', 50);
            $table->string('Proveedor_Telefono', 12);
            $table->string('Proveedor_Direccion', 50);
            $table->unsignedBigInteger('Materia_ID')->nullable(); // Temporal nullable
            $table->timestamps();
            
            // TODO: Agregar FK después de crear materia_prima
            // $table->foreign('Materia_ID')->references('Materia_ID')->on('materia_prima')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedor');
    }
};