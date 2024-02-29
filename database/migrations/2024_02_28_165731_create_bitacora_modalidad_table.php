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
        Schema::create('tb_bitacora_modalidad_proceso', function (Blueprint $table) {
            $table->id();
            $table->string('usuario_ejecutor', 50); // usuario que ejecuta la acción (login)
            $table->string('ip_maquina', 20); // ip de la máquina desde donde se ejecuta la acción
            $table->string('dni_postulante', 8);
            $table->string('numero_documento', 50);
            $table->string('campo_modificado', 20);
            $table->string('valor_anterior', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_bitacora_modalidad_proceso');
    }
};
