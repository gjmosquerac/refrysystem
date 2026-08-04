<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Servicio - LeoTec Refrigeración</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen py-10">
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-lg border border-gray-700">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-cyan-400">LeoTec Refrigeración</h1>
            <p class="text-sm text-gray-400">Solicitud de Servicio Técnico • Carora</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-500/20 border border-red-500 text-red-300 p-3 rounded-lg text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cliente.guardar') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">NOMBRE Y APELLIDO:</label>
                <input type="text" name="nombre" required value="{{ old('nombre') }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="Ej. Juan Pérez">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">TELÉFONO / WHATSAPP:</label>
                <input type="text" name="telefono" required value="{{ old('telefono') }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="Ej. 0414 1234567">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">DIRECCIÓN O SECTOR:</label>
                <input type="text" name="direccion" required value="{{ old('direccion') }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="Ej. Urbanización La Floresta, Carora">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">TIPO DE SERVICIO / EQUIPO:</label>
                <select name="tipo_equipo" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400">
                    <option value="">Seleccione el servicio...</option>
                    <option value="Aire Acondicionado - Mantenimiento Preventivo">Aire Acondicionado - Mantenimiento Preventivo</option>
                    <option value="Aire Acondicionado - Correctivo / Falla">Aire Acondicionado - Reparación (Correctivo)</option>
                    <option value="Nevera / Refrigeración - Revisión">Nevera / Refrigeración - Revisión</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">DETALLES DEL EQUIPO Y FALLA:</label>
                <textarea name="falla" required rows="3" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-400" placeholder="Ej. Aire Split Haier 12k no enfría bien y parpadea...">{{ old('falla') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2">
                <span>💬 ENVIAR SOLICITUD POR WHATSAPP</span>
            </button>
        </form>
    </div>
</body>
</html>