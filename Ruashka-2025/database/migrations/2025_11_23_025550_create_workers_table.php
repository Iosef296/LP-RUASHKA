<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dni')->unique();
            $table->string('email')->unique();
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('direccion')->nullable();
            $table->string('cargo');
            $table->date('fecha_ingreso');
            $table->decimal('salario', 10, 2);
            $table->string('tipo_contrato');
            $table->string('estado')->default('activo');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
