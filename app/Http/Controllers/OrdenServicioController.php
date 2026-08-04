<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenServicioController extends Controller
{
    public function guardar(Request $request)
    {
        // Validación de los datos recibidos del formulario
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'telefono'  => 'required|string|max:50',
            'direccion' => 'required|string',
            'tipo_equipo' => 'required|string|max:100',
            'marca'     => 'nullable|string|max:100',
            'falla'     => 'required|string',
        ]);

        // Estructura de datos para el cliente y el equipo
        $cliente = (object)[
            'nombre'    => $request->nombre,
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
        ];

        $equipo = (object)[
            'tipo_equipo' => $request->tipo_equipo,
            'marca'       => $request->marca ?? 'No especificada',
        ];

        // Número real del técnico configurado
        $telefonoAdminInput = "04245652208"; 

        // Limpieza de espacios, guiones y ajuste del código de país venezolano (+58)
        $telefonoLimpio = preg_replace('/[^0-9]/', '', $telefonoAdminInput);
        if (str_starts_with($telefonoLimpio, '0')) {
            $telefonoLimpio = '58' . ltrim($telefonoLimpio, '0');
        } elseif (!str_starts_with($telefonoLimpio, '58')) {
            $telefonoLimpio = '58' . $telefonoLimpio;
        }

        // Estructura del mensaje para WhatsApp
        $mensaje = "*LEOTEC REFRIGERACIÓN - NUEVA SOLICITUD*\n\n" .
                   "*Cliente:* {$cliente->nombre}\n" .
                   "*Teléfono:* {$cliente->telefono}\n" .
                   "*Dirección:* {$cliente->direccion}\n" .
                   "*Tipo de Equipo:* {$equipo->tipo_equipo}\n" .
                   "*Marca:* {$equipo->marca}\n" .
                   "*Falla Reportada:* {$request->falla}\n\n" .
                   "_Atiende la orden desde el sistema web._";

        // Generación del enlace oficial wa.me limpio
        $urlWhatsApp = "https://wa.me/" . $telefonoLimpio . "?text=" . rawurlencode($mensaje);

        return redirect()->away($urlWhatsApp);
    }
}