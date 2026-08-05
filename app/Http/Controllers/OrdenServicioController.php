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

    // Método principal para guardar la orden
    public function guardar(Request $request)
    {
        return $this->procesarWhatsApp($request);
    }

    // Alias por si la ruta llama a guardarSolicitud
    public function guardarSolicitud(Request $request)
    {
        return $this->procesarWhatsApp($request);
    }

    // Lógica central para limpiar número, armar mensaje y redirigir
    private function procesarWhatsApp(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'telefono'  => 'required|string|max:50',
            'direccion' => 'required|string',
            'tipo_equipo' => 'required|string|max:100',
            'marca'     => 'nullable|string|max:100',
            'falla'     => 'required|string',
        ]);

        $cliente = (object)[
            'nombre'    => $request->nombre,
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
        ];

        $equipo = (object)[
            'tipo_equipo' => $request->tipo_equipo,
            'marca'       => $request->marca ?? 'No especificada',
        ];

        // Número exacto y verificado del técnico en formato internacional
        $telefonoLimpio = "584245652208";

        $mensaje = "*LEOTEC REFRIGERACIÓN - NUEVA SOLICITUD*\n\n" .
                   "*Cliente:* {$cliente->nombre}\n" .
                   "*Teléfono:* {$cliente->telefono}\n" .
                   "*Dirección:* {$cliente->direccion}\n" .
                   "*Tipo de Equipo:* {$equipo->tipo_equipo}\n" .
                   "*Marca:* {$equipo->marca}\n" .
                   "*Falla Reportada:* {$request->falla}\n\n" .
                   "_Atiende la orden desde el sistema web._";

        $urlWhatsApp = "https://wa.me/" . $telefonoLimpio . "?text=" . rawurlencode($mensaje);

        return redirect()->away($urlWhatsApp);
    }
}