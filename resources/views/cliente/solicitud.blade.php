<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Servicio - LeoTec Refrigeración | Carora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-6 space-y-4">
        <!-- Encabezado -->
        <div class="text-center border-b pb-3">
            <h1 class="font-bold text-xl text-blue-600">❄️ LeoTec Refrigeración</h1>
            <p class="text-xs text-slate-500 font-semibold">Solicitud de Servicio Técnico • Carora</p>
        </div>

        <!-- Formulario del Cliente -->
        <form action="{{ route('cliente.store') }}" method="POST" class="space-y-3 text-xs">
            @csrf
            
            <div>
                <label class="font-bold uppercase text-slate-700">Nombre y Apellido:</label>
                <input type="text" name="nombre" required class="w-full mt-1 p-2.5 border rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej. Juan Pérez">
            </div>

            <div>
                <label class="font-bold uppercase text-slate-700">Teléfono / WhatsApp:</label>
                <input type="text" name="telefono" required class="w-full mt-1 p-2.5 border rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej. 0414-1234567">
            </div>

            <div>
                <label class="font-bold uppercase text-slate-700">Dirección o Sector:</label>
                <input type="text" name="direccion" required class="w-full mt-1 p-2.5 border rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej. Urbanización La Floresta, Carora">
            </div>

            <div>
                <label class="font-bold uppercase text-slate-700">Tipo de Servicio:</label>
                <select name="tipo_servicio" required class="w-full mt-1 p-2.5 border rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="" disabled selected>Seleccione el servicio...</option>
                    <option value="Mantenimiento Preventivo">Mantenimiento Preventivo</option>
                    <option value="Instalación">Instalación</option>
                    <option value="Reparación / Revisión de Falla">Reparación / Revisión de Falla</option>
                    <option value="Carga de Gas">Carga de Gas</option>
                </select>
            </div>

            <div>
                <label class="font-bold uppercase text-slate-700">Detalles del Equipo y Falla:</label>
                <textarea name="detalles_falla" rows="3" required class="w-full mt-1 p-2.5 border rounded-xl bg-slate-50 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej. Aire Split Haier 12k no enfría bien y parpadea..."></textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow uppercase tracking-wider text-xs flex items-center justify-center gap-1.5 transition-all">
                <span>💬</span> Enviar Solicitud por WhatsApp
            </button>
        </form>
    </div>

</body>
</html>