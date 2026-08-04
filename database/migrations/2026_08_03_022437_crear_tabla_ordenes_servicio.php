<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ordenes_servicio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users'); // Técnico en campo
            $table->enum('tipo_servicio', ['Preventivo', 'Correctivo', 'Instalación']);
            $table->decimal('voltaje_entrada', 8, 2)->nullable();
            $table->decimal('amperaje_trabajo', 8, 2)->nullable();
            $table->decimal('presion_baja', 8, 2)->nullable();
            $table->decimal('presion_alta', 8, 2)->nullable();
            $table->decimal('temp_suministro', 8, 2)->nullable();
            $table->decimal('temp_retorno', 8, 2)->nullable();
            $table->text('diagnostico_tecnico');
            $table->text('trabajo_realizado');
            $table->string('estado')->default('Finalizado');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ordenes_servicio');
    }
};