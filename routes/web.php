<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenServicioController;
use App\Models\Equipo;
use App\Models\OrdenServicio;
use App\Http\Controllers\EquipoController;

// Ruta principal: Formulario móvil de campo
Route::get('/', function () {
    $equipos = Equipo::with('cliente')->get();
    return view('ordenes.crear', compact('equipos'));
});

// Ruta que procesa el formulario
Route::post('/ordenes', [OrdenServicioController::class, 'store'])->name('ordenes.store');

// Historial de órdenes
Route::get('/ordenes', function () {
    $ordenes = OrdenServicio::with(['equipo.cliente', 'tecnico'])->latest()->get();
    return view('ordenes.index', compact('ordenes'));
})->name('ordenes.index');

// Detalle individual de una orden
Route::get('/ordenes/{id}', function ($id) {
    $orden = OrdenServicio::with(['equipo.cliente', 'tecnico'])->findOrFail($id);
    return view('ordenes.show', compact('orden'));
})->name('ordenes.show');

// Rutas públicas para el formulario de solicitud del cliente
Route::get('/solicitar-servicio', [OrdenServicioController::class, 'formCliente'])->name('cliente.solicitar');
Route::post('/solicitar-servicio', [OrdenServicioController::class, 'guardarSolicitud'])->name('cliente.store');


// Ruta para disparar el envío de WhatsApp desde el panel del técnico
Route::get('/ordenes/{orden}/whatsapp', [OrdenServicioController::class, 'enviarWhatsApp'])->name('ordenes.whatsapp');

Route::post('/equipos/store-ajax', [EquipoController::class, 'storeAjax'])->name('equipos.storeAjax');

// Ruta para el registro rápido vía AJAX
Route::post('/clientes/store-fast', [EquipoController::class, 'storeFast'])->name('clientes.store.fast');
