<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefriSystem - Campo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-xl flex flex-col">
        <header class="bg-blue-600 text-white p-4 text-center font-bold text-lg shadow-md flex justify-between items-center">
    <span>❄️ LeoTec Refrigeración</span>
    <span class="text-xs bg-blue-700 px-3 py-1.5 rounded-lg">Carora</span>
        </header>

        <main class="p-4 flex-1">
            <form action="{{ route('ordenes.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Equipo / Cliente</label>
                    <select name="equipo_id" class="w-full mt-1 p-3 bg-slate-50 border border-slate-300 rounded-xl" required>
                        <option value="">Seleccione equipo a revisar...</option>
                        @foreach($equipos as $eq)
                            <option value="{{ $eq->id }}">{{ $eq->tipo_equipo }} - {{ $eq->marca }} ({{ $eq->cliente->nombre ?? 'Sin cliente' }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Tipo de Servicio</label>
                    <select name="tipo_servicio" class="w-full mt-1 p-3 bg-slate-50 border border-slate-300 rounded-xl" required>
                        <option value="Preventivo">Mantenimiento Preventivo</option>
                        <option value="Correctivo">Mantenimiento Correctivo / Reparación</option>
                        <option value="Instalación">Instalación</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3 bg-slate-50 p-3 rounded-xl border border-slate-200">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600">Presión Baja (PSI)</label>
                        <input type="number" step="0.1" name="presion_baja" class="w-full mt-1 p-2 bg-white border rounded-lg text-sm" placeholder="Ej. 120">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600">Presión Alta (PSI)</label>
                        <input type="number" step="0.1" name="presion_alta" class="w-full mt-1 p-2 bg-white border rounded-lg text-sm" placeholder="Ej. 350">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600">Voltaje (V)</label>
                        <input type="number" step="0.1" name="voltaje_entrada" class="w-full mt-1 p-2 bg-white border rounded-lg text-sm" placeholder="Ej. 220">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600">Amperaje (A)</label>
                        <input type="number" step="0.1" name="amperaje_trabajo" class="w-full mt-1 p-2 bg-white border rounded-lg text-sm" placeholder="Ej. 8.5">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Diagnóstico Técnico</label>
                    <textarea name="diagnostico_tecnico" rows="2" class="w-full mt-1 p-3 bg-slate-50 border border-slate-300 rounded-xl text-sm" placeholder="Describa la falla encontrada..." required></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Trabajo Realizado</label>
                    <textarea name="trabajo_realizado" rows="2" class="w-full mt-1 p-3 bg-slate-50 border border-slate-300 rounded-xl text-sm" placeholder="Limpieza de serpentín, ajuste..." required></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-xl shadow-lg active:bg-blue-700 transition uppercase tracking-wider text-sm">
                    Guardar Orden de Servicio
                </button>
            </form>
        </main>
    </div>

</body>
</html>