<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenServicioController;
use App\Models\Equipo;
use App\Models\OrdenServicio;
use App\Http\Controllers\EquipoController;

// Ruta principal: Formulario móvil de campo (Carga la vista de creación en la raíz)
Route::get('/', function () {
    $equipos = Equipo::with('cliente')->get();
    return view('ordenes.crear', compact('equipos'));
})->name('home');

// Ruta que procesa el formulario principal (POST)
Route::post('/ordenes', [OrdenServicioController::class, 'store'])->name('ordenes.store');

// Historial de órdenes (Cambiado a /ordenes/historial para evitar conflicto GET con la raíz o el formulario)
Route::get('/ordenes/historial', function () {
    $ordenes = OrdenServicio::with(['equipo.cliente'])->latest()->get();
    return view('ordenes.index', compact('ordenes'));
})->name('ordenes.index');

// Detalle individual de una orden
Route::get('/ordenes/{id}', function ($id) {
    $orden = OrdenServicio::with(['equipo.cliente'])->findOrFail($id);
    return view('ordenes.show', compact('orden'));
})->name('ordenes.show');

// Rutas públicas para el formulario de solicitud del cliente
Route::get('/solicitar-servicio', [OrdenServicioController::class, 'formCliente'])->name('cliente.solicitar');
Route::post('/solicitar-servicio', [OrdenServicioController::class, 'guardarSolicitud'])->name('cliente.store');

// Ruta para disparar el envío de WhatsApp desde el panel del técnico
Route::get('/ordenes/{orden}/whatsapp', [OrdenServicioController::class, 'enviarWhatsApp'])->name('ordenes.whatsapp');

// Rutas AJAX para equipos y registro rápido
Route::post('/equipos/store-ajax', [EquipoController::class, 'storeAjax'])->name('equipos.storeAjax');
Route::post('/clientes/store-fast', [EquipoController::class, 'storeFast'])->name('clientes.store.fast');