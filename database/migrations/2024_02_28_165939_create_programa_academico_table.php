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
        Schema::create('tb_programa_academico', function (Blueprint $table) {
            $table->id();
            $table->char('codigo', 2);
            $table->string('nombre', 60);
            $table->integer('estado');
            $table->unsignedBigInteger('sede_id');
            $table->unsignedBigInteger('facultad_id');
            $table->unsignedBigInteger('grupo_academico_id');
            $table->foreign('sede_id')->references('id')->on('tb_sede');
            $table->foreign('facultad_id')->references('id')->on('tb_facultad');
            $table->foreign('grupo_academico_id')->references('id')->on('tb_grupo_academico');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_programa_academico');
    }
};
