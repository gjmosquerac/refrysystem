<!-- Ubicación: resources/views/welcome.blade.php (Por si railway levanta esta vista en la ruta raíz) -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LeoTec Refrigeración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-800 rounded-xl shadow-2xl p-6 border border-slate-700 text-center">
        <h1 class="text-2xl font-bold text-emerald-400 mb-2">LEOTEC REFRIGERACIÓN</h1>
        <p class="text-sm text-slate-400 mb-6">Solicitud de Servicio Técnico a Domicilio</p>
        <a href="{{ route('cliente.solicitud') }}" class="inline-block w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-lg transition duration-200 shadow-lg">
            Ir al Formulario de Solicitud
        </a>
    </div>
</body>
</html>