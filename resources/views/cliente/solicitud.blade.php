<!-- resources/views/cliente/solicitud.blade.php -->
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
            <p class="text-sm text-slate-400">Solicitud de Servicio Técnico en Sitio</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-900/50 border border-red-500 rounded-lg text-sm text-red-200">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('solicitud.guardar') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Nombre y Apellido</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full bg-slate-900 border border-slate-750 rounded-lg px-3 py-2 text-slate-100 focus:outline-none focus:border-emerald-500" placeholder="Ej. Guillermo Mosquera">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Teléfono (WhatsApp)</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" required class="w-full bg-slate-900 border border-slate-750 rounded-lg px-3 py-2 text-slate-100 focus:outline-none focus:border-emerald-500" placeholder="Ej. 0412194489">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Dirección</label>
                <textarea name="direccion" rows="2" required class="w-full bg-slate-900 border border-slate-750 rounded-lg px-3 py-2 text-slate-100 focus:outline-none focus:border-emerald-500" placeholder="Ubicación exacta...">{{ old('direccion') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Tipo de Equipo</label>
                <input type="text" name="tipo_equipo" value="{{ old('tipo_equipo') }}" required class="w-full bg-slate-900 border border-slate-750 rounded-lg px-3 py-2 text-slate-100 focus:outline-none focus:border-emerald-500" placeholder="Ej. Aire Acondicionado Split">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Marca (Opcional)</label>
                <input type="text" name="marca" value="{{ old('marca') }}" class="w-full bg-slate-900 border border-slate-750 rounded-lg px-3 py-2 text-slate-100 focus:outline-none focus:border-emerald-500" placeholder="Ej. Haier / LG">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-1">Falla Reportada</label>
                <textarea name="falla" rows="3" required class="w-full bg-slate-900 border border-slate-750 rounded-lg px-3 py-2 text-slate-100 focus:outline-none focus:border-emerald-500" placeholder="Describa la falla del equipo...">{{ old('falla') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-lg flex items-center justify-center space-x-2">
                <span>Enviar Solicitud a WhatsApp</span>
            </button>
        </form>
    </div>
</body>
</html>