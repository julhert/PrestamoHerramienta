<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('prestamo_detalles', function (Blueprint $table) {
            // El ID del almacenista que tiene la sesión abierta (ej. Ángel)
            $table->foreignId('entregado_por_id')->nullable()->constrained('users');
            
            // El ID del almacenista que recibe físicamente (ej. Pepe)
            $table->foreignId('recibido_por_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestamo_detalles', function (Blueprint $table) {
            $table->dropForeign(['entregado_por_id']);
            $table->dropForeign(['recibido_por_id']);
            $table->dropColumn(['entregado_por_id', 'recibido_por_id']);
        });
    }
};
