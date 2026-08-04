<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenServicioController;
use App\Models\OrdenServicio;
use App\Http\Controllers\EquipoController;

// 1. LA RAÍZ (/) ES PARA EL CLIENTE: Formulario público de solicitud
Route::get('/', [OrdenServicioController::class, 'formCliente'])->name('cliente.solicitar');
Route::post('/', [OrdenServicioController::class, 'guardarSolicitud'])->name('cliente.store');

// 2. EL PANEL DEL TÉCNICO: Creación de órdenes técnicas con presiones y voltajes
Route::get('/ordenes/crear', [OrdenServicioController::class, 'create'])->name('ordenes.create');
Route::post('/ordenes', [OrdenServicioController::class, 'store'])->name('ordenes.store');

// Historial y detalles de órdenes para el técnico
Route::get('/ordenes', function () {
    $ordenes = OrdenServicio::with(['equipo.cliente', 'tecnico'])->latest()->get();
    return view('ordenes.index', compact('ordenes'));
})->name('ordenes.index');

Route::get('/ordenes/{id}', function ($id) {
    $orden = OrdenServicio::with(['equipo.cliente', 'tecnico'])->findOrFail($id);
    return view('ordenes.show', compact('orden'));
})->name('ordenes.show');

// Ruta para disparar el envío de WhatsApp desde el panel del técnico
Route::get('/ordenes/{orden}/whatsapp', [OrdenServicioController::class, 'enviarWhatsApp'])->name('ordenes.whatsapp');

// Rutas AJAX rápidas
Route::post('/equipos/store-ajax', [EquipoController::class, 'storeAjax'])->name('equipos.storeAjax');
Route::post('/clientes/store-fast', [EquipoController::class, 'storeFast'])->name('clientes.store.fast');