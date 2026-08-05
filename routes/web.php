<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdenServicioController;

Route::get('/', [OrdenServicioController::class, 'formCliente'])->name('cliente.solicitud');
Route::post('/solicitud/guardar', [OrdenServicioController::class, 'guardarSolicitud'])->name('solicitud.guardar');

Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/ordenes/crear', [OrdenServicioController::class, 'create'])->name('ordenes.create');
    Route::post('/ordenes/guardar', [OrdenServicioController::class, 'store'])->name('ordenes.store');
    Route::get('/ordenes', [OrdenServicioController::class, 'index'])->name('ordenes.index');
    Route::get('/ordenes/{orden}/whatsapp', [OrdenServicioController::class, 'enviarWhatsApp'])->name('ordenes.whatsapp');
});