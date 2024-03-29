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
        Schema::create('tb_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nuDniUsuario');
            $table->string('nombresApellidos');
            $table->string('password');
            $table->integer('numeroConsultas');
            $table->dateTime('fechaActualizacionCredencial');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_settings');
    }
};
