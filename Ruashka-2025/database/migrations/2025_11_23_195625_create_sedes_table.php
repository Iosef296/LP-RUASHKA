<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('departamento');
            $table->string('telefono');
            $table->string('email')->nullable();
            $table->string('encargado')->nullable();
            $table->integer('capacidad')->default(0);
            $table->string('tipo'); // central, regional, sucursal
            $table->string('estado')->default('activa'); // activa, inactiva, mantenimiento
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sedes');
    }
};
