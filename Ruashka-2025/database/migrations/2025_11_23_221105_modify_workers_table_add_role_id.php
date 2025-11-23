<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            // Si ya tienes el campo 'cargo', lo eliminamos
            if (Schema::hasColumn('workers', 'cargo')) {
                $table->dropColumn('cargo');
            }
            // Agregamos role_id
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->string('cargo')->nullable();
        });
    }
};
