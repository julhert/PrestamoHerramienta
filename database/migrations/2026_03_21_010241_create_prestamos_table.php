<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Prestamo;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestatario_id')->constrained('prestatarios');
            $table->foreignId('user_id')->constrained('users');
            $table->string('materia', 150)->nullable();
            $table->timestamp('fecha_prestamo')->useCurrent();
            $table->timestamp('fecha_limite');
            $table->timestamp('fecha_devolucion_real')->nullable();
            $table->boolean('acepto_terminos')->default(false);
            $table->string('estado_prestamo', 50)->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};
