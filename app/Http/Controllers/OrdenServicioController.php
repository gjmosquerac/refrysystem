<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrdenServicio;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\User;

class OrdenServicioController extends Controller
{
    /**
     * Muestra el formulario para crear una nueva orden con los equipos cargados.
     */
    public function create()
    {
        $equipos = Equipo::with('cliente')->get();
        return view('ordenes.crear', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_servicio' => 'required|string',
            'diagnostico_tecnico' => 'required|string',
            'trabajo_realizado' => 'required|string',
        ]);

        $equipoId = $request->equipo_id;

        // Si el usuario usó el bloque de registro rápido arriba
        if ($request->filled('nuevo_cliente_nombre') && $request->filled('nuevo_tipo_equipo')) {
            $cliente = Cliente::create([
                'nombre' => $request->nuevo_cliente_nombre,
                'telefono' => $request->nuevo_cliente_telefono ?? 'Sin teléfono',
                'direccion' => 'Registrado en campo',
            ]);

            $equipo = Equipo::create([
                'cliente_id' => $cliente->id,
                'tipo_equipo' => $request->nuevo_tipo_equipo,
                'marca' => $request->nuevo_marca_equipo ?? 'Genérica',
            ]);

            $equipoId = $equipo->id;
        }

        // Validación lógica: si no seleccionó nada ni tampoco registró uno nuevo, se devuelve
        if (! $equipoId) {
            return back()->withErrors(['equipo_id' => 'Debe seleccionar un equipo existente o llenar los datos del cliente nuevo arriba.'])->withInput();
        }

        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Técnico Principal',
                'email' => 'tecnico@refrysystem.com',
                'password' => bcrypt('password123'),
            ]);
        }

        OrdenServicio::create([
            'equipo_id' => $equipoId,
            'tipo_servicio' => $request->tipo_servicio,
            'presion_baja' => $request->presion_baja,
            'presion_alta' => $request->presion_alta,
            'voltaje_entrada' => $request->voltaje_entrada,
            'amperaje_trabajo' => $request->amperaje_trabajo,
            'diagnostico_tecnico' => $request->diagnostico_tecnico,
            'trabajo_realizado' => $request->trabajo_realizado,
            'user_id' => $user->id,
        ]);

        return redirect()->route('ordenes.index')->with('success', '¡Orden guardada con éxito!');
    }

    // Muestra el formulario al cliente en la raíz (/)
    // Muestra el formulario al cliente en la raíz (/)
    public function formCliente()
    {
        return view('cliente.solicitud');
    }

    // Procesa la solicitud que hace el cliente en la web de forma automatizada
    public function guardarSolicitud(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'direccion' => 'required|string',
            'falla' => 'required|string',
        ]);

        // 1. Crear o buscar al cliente de manera inteligente
        $cliente = Cliente::firstOrCreate(
            ['telefono' => $request->telefono],
            [
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
            ]
        );

        // 2. Registrar el equipo asociado con la falla del cliente
        $equipo = Equipo::create([
            'cliente_id' => $cliente->id,
            'tipo_equipo' => $request->tipo_equipo,
            'marca' => $request->marca ?? 'Genérica / Por definir',
            'refrigerante' => 'R22/R410A', // <--- METE ESTA LÍNEA AQUÍ MISMO
        ]);

        // 3. Generar la orden inicial con estatus operativo pendiente
        $orden = OrdenServicio::create([
            'equipo_id' => $equipo->id,
            'tipo_servicio' => 'Correctivo',
            'diagnostico_tecnico' => 'Falla reportada por el cliente: ' . $request->falla,
            'trabajo_realizado' => 'Pendiente por revisión técnica en sitio.',
            'user_id' => User::first()->id ?? 1,
        ]);

        // 4. Enlace directo y automatizado para la acción del técnico en sitio
        $urlAtender = route('ordenes.create', ['equipo_id' => $equipo->id]);

        // 5. Estructura del mensaje de alerta viral/técnico directo a tu WhatsApp
        $telefonoAdmin = "58424194489"; // Tu número de técnico oficial
        $mensaje = "❄️ *LEOTEC REFRIGERACIÓN - NUEVA SOLICITUD* ❄️\n\n" .
                   "👤 *Cliente:* {$cliente->nombre}\n" .
                   "📱 *Teléfono:* {$cliente->telefono}\n" .
                   "📍 *Ubicación:* {$cliente->direccion}\n" .
                   "⚠️ *Falla Reportada:* {$request->falla}\n" .
                   "🔢 *Nro de Orden:* #000{$orden->id}\n\n" .
                   "⚡ *Gestionar en el Sistema:* {$urlAtender}";

        $whatsappUrl = "https://wa.me/{$telefonoAdmin}?text=" . urlencode($mensaje);

        // Disparo limpio hacia la central de WhatsApp
        return redirect()->away($whatsappUrl);
    }

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