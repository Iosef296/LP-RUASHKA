<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materia_prima', function (Blueprint $table) {
            $table->id('Materia_ID');
            $table->string('Materia_Nombre', 50);
            $table->string('Materia_Descripcion', 500);
            $table->string('Materia_Unidad_Medida', 50);
            $table->integer('Materia_Stock');
            $table->unsignedBigInteger('Ord_Produc_ID');
            $table->timestamps();

            $table->foreign('Ord_Produc_ID')->references('Ord_Produc_ID')->on('orden_de_produccion')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materia_prima');
    }
};