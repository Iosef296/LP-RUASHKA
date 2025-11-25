<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orden_de_produccion', function (Blueprint $table) {
            $table->text('Ord_Prod_Observaciones')->nullable()->after('Ord_Prod_Estado');
            $table->integer('Ord_Prod_Prioridad')->default(1)->after('Ord_Prod_Estado'); // 1=Baja, 2=Media, 3=Alta
            $table->decimal('Ord_Prod_Costo_Estimado', 10, 2)->nullable()->after('Ord_Prod_Cantidad');
            $table->string('Ord_Prod_Cliente', 100)->nullable()->after('Ord_Prod_Tipo_Producto');
        });
    }

    public function down(): void
    {
        Schema::table('orden_de_produccion', function (Blueprint $table) {
            $table->dropColumn(['Ord_Prod_Observaciones', 'Ord_Prod_Prioridad', 'Ord_Prod_Costo_Estimado', 'Ord_Prod_Cliente']);
        });
    }
};