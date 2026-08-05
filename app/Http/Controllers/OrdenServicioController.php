<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    public function formCliente()
    {
        if (view()->exists('cliente.solicitud')) {
            return view('cliente.solicitud');
        }
        if (view()->exists('ordenes.crear')) {
            return view('ordenes.crear');
        }
        return view('welcome');
    }

    public function guardarSolicitud(Request $request)
    {
        $telefonoLimpio = "584245652208";

        $telefonoLimpio = "584245652208";
        $urlSistema = url('/login');
        $mensaje = "*LEOTEC REFRIGERACIÓN - NUEVA SOLICITUD*\n\n" .
                   "*Cliente:* {$request->nombre}\n" .
                   "*Teléfono:* {$request->telefono}\n" .
                   "*Dirección:* {$request->direccion}\n" .
                   "*Tipo de Equipo:* {$request->tipo_equipo}\n" .
                   "*Marca:* " . ($request->marca ?? 'No especificada') . "\n" .
                   "*Falla Reportada:* {$request->falla}\n\n" .
                   "Atiende la orden desde el sistema web:\n" . $urlSistema;

        $urlWhatsApp = "https://wa.me/" . $telefonoLimpio . "?text=" . rawurlencode($mensaje);

        return redirect()->away($urlWhatsApp);
    }
}