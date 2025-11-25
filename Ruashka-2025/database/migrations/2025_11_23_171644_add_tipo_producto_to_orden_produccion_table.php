<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orden_de_produccion', function (Blueprint $table) {
    if (!Schema::hasColumn('orden_de_produccion', 'Ord_Prod_Tipo_Producto')) {
        $table->string('Ord_Prod_Tipo_Producto', 100)->nullable()->after('Ord_Prod_Cantidad');
    }
});

    }

    public function down(): void
    {
        Schema::table('orden_de_produccion', function (Blueprint $table) {
            $table->dropColumn('Ord_Prod_Tipo_Producto');
        });
    }
};