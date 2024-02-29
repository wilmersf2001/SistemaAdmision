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
        Schema::create('tb_modalidad', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->decimal('monto_nacional', 10, 2);
            $table->decimal('monto_particular', 10, 2);
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('id')->on('tb_examen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_modalidad');
    }
};
