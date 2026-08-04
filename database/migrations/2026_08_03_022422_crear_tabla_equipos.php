<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->string('tipo_equipo'); // Split, Cava Cuarto, Nevera Comercial, Chiller
            $table->string('marca');
            $table->string('modelo')->nullable();
            $table->string('serial')->nullable();
            $table->string('refrigerante'); // R-22, R-410A, R-134a, R-32, etc.
            $table->text('ubicacion_especifica')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('equipos');
    }
};