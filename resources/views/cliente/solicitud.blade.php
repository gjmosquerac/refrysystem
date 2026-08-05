<!-- Ubicación: resources/views/cliente/solicitud.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Servicio - LeoTec Refrigeración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-800 rounded-xl shadow-2xl p-6 border border-slate-700">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-emerald-400">LEOTEC REFRIGERACIÓN</h1>
            <p class="text-sm text-slate-400">Solicitud de Servicio Técnico a Domicilio</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-900/50 border border-red-500 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cliente.guardar') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-medium text-slate-300 uppercase mb-1">Nombre y Apellido</label>
                <input type="text" name="nombre" required placeholder="Ej. Guillermo Mosquera" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 uppercase mb-1">Teléfono (WhatsApp)</label>
                <input type="text" name="telefono" required placeholder="Ej. 0412194489" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 uppercase mb-1">Dirección</label>
                <textarea name="direccion" required rows="2" placeholder="Ubicación exacta..." class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500"></textarea>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 uppercase mb-1">Tipo de Equipo</label>
                <input type="text" name="tipo_equipo" required placeholder="Ej. Aire Acondicionado Split" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 uppercase mb-1">Marca (Opcional)</label>
                <input type="text" name="marca" placeholder="Ej. Haier / LG" class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-300 uppercase mb-1">Falla Reportada</label>
                <textarea name="falla" required rows="3" placeholder="Describa la falla del equipo..." class="w-full px-3 py-2 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-emerald-500"></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-lg transition duration-200 shadow-lg">
                Enviar Solicitud por WhatsApp
            </button>
        </form>
    </div>
</body>
</html>