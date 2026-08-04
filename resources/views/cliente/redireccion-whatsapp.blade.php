<!-- resources/views/cliente/redireccion-whatsapp.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirigiendo a WhatsApp...</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-slate-800 rounded-xl shadow-2xl p-6 border border-slate-700 text-center space-y-4">
        <h2 class="text-xl font-bold text-emerald-400">¡Solicitud Registrada con Éxito!</h2>
        <p class="text-sm text-slate-300">Abriendo WhatsApp automáticamente para enviar la alerta al técnico...</p>
        
        <div class="flex justify-center">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-emerald-500"></div>
        </div>

        <div class="pt-4">
            <a id="whatsapp-link" href="#" class="inline-block bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 px-4 rounded-lg transition duration-200 text-sm">
                Haz clic aquí si no se abre automáticamente
            </a>
        </div>
    </div>

    <script>
        const telefono = "{{ str_replace(['+', ' '], '', $telefono) }}";
        const mensaje = @json($mensaje);

        const urlWhatsApp = `https://api.whatsapp.com/send?phone=${telefono}&text=${encodeURIComponent(mensaje)}`;
        
        document.getElementById('whatsapp-link').href = urlWhatsApp;

        window.location.href = urlWhatsApp;
    </script>
</body>
</html>