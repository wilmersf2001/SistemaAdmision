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
        Schema::create('tb_facultad', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 2);
            $table->string('nombre', 60);
            $table->string('abreviatura', 10);
            $table->string('decano', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_facultad');
    }
};
