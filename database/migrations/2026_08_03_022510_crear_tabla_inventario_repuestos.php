<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inventario_repuestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_repuesto'); // Ej: Gas R-410A, Capacitor 35µF
            $table->string('codigo')->unique();
            $table->decimal('stock_actual', 10, 2);
            $table->string('unidad_medida'); // Kilogramos, Unidades, Metros
            $table->decimal('precio_unitario', 10, 2);
            $table->timestamps();
        });

        Schema::create('orden_repuesto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_servicio_id')->constrained('ordenes_servicio')->onDelete('cascade');
            $table->foreignId('inventario_repuesto_id')->constrained('inventario_repuestos');
            $table->decimal('cantidad_utilizada', 10, 2);
        });
    }

    public function down(): void {
        Schema::dropIfExists('orden_repuesto');
        Schema::dropIfExists('inventario_repuestos');
    }
};