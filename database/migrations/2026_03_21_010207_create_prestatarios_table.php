<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Prestatario;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestatarios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_control', 20)->unique();
            $table->string('nombre_completo', 150);
            $table->string('tipo_usuario', 50); // alumno, docente, etc.
            $table->string('carrera_departamento', 100)->nullable();
            $table->integer('semestre')->nullable();
            $table->string('grupo', 20)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('estado', 50)->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestatarios');
    }
};
