<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenServicio;

class OrdenServicioController extends Controller
{
    /**
     * Almacena una nueva orden de servicio desde el formulario de campo interno.
     */
    public function store(Request $request)
{
    $request->validate([
        'equipo_id' => 'required|exists:equipos,id',
        'tipo_servicio' => 'required|string',
        'diagnostico_tecnico' => 'required|string',
        'trabajo_realizado' => 'required|string',
    ]);

    OrdenServicio::create([
        'equipo_id' => $request->equipo_id,
        'tipo_servicio' => $request->tipo_servicio,
        'presion_baja' => $request->presion_baja,
        'presion_alta' => $request->presion_alta,
        'voltaje_entrada' => $request->voltaje_entrada,
        'amperaje_trabajo' => $request->amperaje_trabajo,
        'diagnostico_tecnico' => $request->diagnostico_tecnico,
        'trabajo_realizado' => $request->trabajo_realizado,
        'user_id' => 1, // <--- ¡AQUÍ ESTÁ LA SOLUCIÓN AL ERROR DE SQL!
        'tecnico_id' => 1,
    ]);

    return redirect()->route('ordenes.index')->with('success', '¡Orden de servicio guardada con éxito!');
}

    /**
     * Muestra la vista del formulario público para que el cliente solicite servicio.
     */
    public function formCliente()
    {
        return view('cliente.solicitud');
    }

    /**
     * Procesa la solicitud del cliente y lo redirige al WhatsApp del técnico.
     */
    public function guardarSolicitud(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string|max:255',
            'detalles_falla' => 'required|string',
        ]);

        $mensaje = "Hola Leonardo, tengo una nueva solicitud de servicio técnico:%0A" .
                   "👤 *Cliente:* {$request->nombre}%0A" .
                   "📱 *Teléfono:* {$request->telefono}%0A" .
                   "📍 *Dirección:* {$request->direccion}%0A" .
                   "🔧 *Detalles / Falla:* {$request->detalles_falla}";

        $telefonoTecnico = "584245652208";

        return redirect()->away("https://wa.me/{$telefonoTecnico}?text={$mensaje}");
    }

    /**
     * Genera el enlace automatizado de WhatsApp para el cliente desde la orden registrada.
     */
    public function enviarWhatsApp(OrdenServicio $orden)
    {
        $orden->load('equipo.cliente');
        
        $telefono = $orden->equipo->cliente->telefono ?? '';
        $telefonoCliente = preg_replace('/[^0-9]/', '', $telefono);
        if (strlen($telefonoCliente) == 10 && substr($telefonoCliente, 0, 1) != '58') {
            $telefonoCliente = '58' . $telefonoCliente;
        }

        $mensaje = "Saludos *" . ($orden->equipo->cliente->nombre ?? 'Cliente') . "*, le escribe *LeoTec Refrigeración* (Carora).\n" .
                   "Resumen de su servicio N°: 000{$orden->id}\n" .
                   "🔧 *Equipo:* {$orden->equipo->tipo_equipo} - {$orden->equipo->marca}\n" .
                   "🛠️ *Trabajo:* {$orden->trabajo_realizado}\n" .
                   "¡Gracias por confiar en nuestros servicios!";

        $urlWhatsApp = "https://wa.me/{$telefonoCliente}?text=" . urlencode($mensaje);

        return redirect()->away($urlWhatsApp);
    }
}