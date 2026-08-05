<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenServicioController;

// Ruta pública de solicitud del cliente
Route::get('/', [OrdenServicioController::class, 'formCliente'])->name('cliente.solicitud');
Route::post('/solicitud/guardar', [OrdenServicioController::class, 'guardarSolicitud'])->name('solicitud.guardar');

// Ruta de login (temporal para pruebas o acceso directo al panel si no usas auth estricto)
Route::get('/login', [OrdenServicioController::class, 'create'])->name('login');

// Rutas protegidas o abiertas para gestión de órdenes según necesites
Route::get('/ordenes/crear', [OrdenServicioController::class, 'create'])->name('ordenes.create');
Route::post('/ordenes/guardar', [OrdenServicioController::class, 'store'])->name('ordenes.store');
Route::get('/ordenes', [OrdenServicioController::class, 'index'])->name('ordenes.index');
Route::get('/ordenes/{orden}/whatsapp', [OrdenServicioController::class, 'enviarWhatsApp'])->name('ordenes.whatsapp');