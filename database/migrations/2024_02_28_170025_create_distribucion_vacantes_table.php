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
        Schema::create('tb_distribucion_vacantes', function (Blueprint $table) {
            $table->id();
            $table->integer('vacantes');
            $table->unsignedBigInteger('programa_academico_id');
            $table->unsignedBigInteger('modalidad_id');
            $table->unsignedBigInteger('sede_id');
            $table->foreign('programa_academico_id')->references('id')->on('tb_programa_academico');
            $table->foreign('modalidad_id')->references('id')->on('tb_modalidad');
            $table->foreign('sede_id')->references('id')->on('tb_sede');
            $table->unique(['programa_academico_id', 'modalidad_id', 'sede_id'], 'unique_distribucion_vacante');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_distribucion_vacantes');
    }
};
