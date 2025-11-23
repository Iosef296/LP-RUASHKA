<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orden_de_produccion', function (Blueprint $table) {
            $table->id('Ord_Produc_ID');
            $table->date('Ord_Prod_Fecha_Inicio');
            $table->date('Ord_Prod_Fecha_Final');
            $table->integer('Ord_Prod_Cantidad');
            $table->string('Ord_Prod_Estado');
            $table->unsignedBigInteger('Rol_ID');
            $table->timestamps();
            $table->string('Ord_Prod_Tipo_Producto');

            $table->foreign('Rol_ID')->references('Rol_ID')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orden_de_produccion');
    }
};