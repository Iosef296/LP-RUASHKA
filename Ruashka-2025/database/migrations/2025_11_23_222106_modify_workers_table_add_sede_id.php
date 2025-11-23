<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            // Si ya tienes el campo 'departamento', lo eliminamos
            if (Schema::hasColumn('workers', 'departamento')) {
                $table->dropColumn('departamento');
            }
            // Agregamos sede_id
            $table->foreignId('sede_id')->nullable()->constrained('sedes')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropForeign(['sede_id']);
            $table->dropColumn('sede_id');
            $table->string('departamento')->nullable();
        });
    }
};
