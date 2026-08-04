<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial - RefriSystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-xl flex flex-col">
        <header class="bg-blue-600 text-white p-4 text-center font-bold text-lg shadow-md flex justify-between items-center">
    <span>❄️ LeoTec Refrigeración</span>
    <span class="text-xs bg-blue-700 px-3 py-1.5 rounded-lg">Carora</span>
        </header>

        <main class="p-4 flex-1 space-y-3">
            @forelse($ordenes as $orden)
                <div class="bg-slate-50 border border-slate-200 p-4 rounded-xl shadow-sm space-y-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-[10px] font-bold uppercase bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">{{ $orden->tipo_servicio }}</span>
                            <h3 class="font-bold text-slate-800 mt-1">{{ $orden->equipo->tipo_equipo ?? 'Equipo' }} - {{ $orden->equipo->marca ?? '' }}</h3>
                        </div>
                        <span class="text-xs text-slate-400">{{ $orden->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    
                    <p class="text-xs text-slate-600"><strong>Cliente:</strong> {{ $orden->equipo->cliente->nombre ?? 'N/D' }}</p>
                    <p class="text-xs text-slate-600"><strong>Diagnóstico:</strong> {{ Str::limit($orden->diagnostico_tecnico, 60) }}</p>

                    <div class="pt-2 flex justify-end">
                        <a href="{{ route('ordenes.show', $orden->id) }}" class="text-xs bg-slate-800 text-white px-3 py-1.5 rounded-lg font-semibold">
                            Ver Reporte Completo &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-slate-400 text-sm">
                    No hay órdenes registradas todavía.
                </div>
            @endforelse
        </main>
    </div>

</body>
</html>