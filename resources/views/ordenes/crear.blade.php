<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Orden de Servicio - RefrySystem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="max-w-md mx-auto min-h-screen bg-white shadow-xl flex flex-col">
        <header class="bg-blue-600 text-white p-4 text-center font-bold text-lg">
            Nueva Orden de Servicio
        </header>

        <main class="p-4 flex-1">
            <form action="{{ route('ordenes.store') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <!-- SECCIÓN: REGISTRO RÁPIDO DE CLIENTE Y EQUIPO -->
                <div class="bg-blue-50 border border-blue-200 p-3 rounded-lg flex flex-col gap-3">
                    <span class="text-xs font-bold text-blue-700 uppercase">¿Cliente o equipo nuevo? Regístralo aquí</span>
                    
                    <div class="grid grid-cols-2 gap-2">
                        <div class="flex flex-col gap-1">
                            <label class="block text-[10px] font-bold text-slate-600 uppercase">Nombre del Cliente</label>
                            <input type="text" name="nuevo_cliente_nombre" class="w-full p-2 bg-white border border-slate-300 rounded text-xs focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: Juan Pérez">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="block text-[10px] font-bold text-slate-600 uppercase">Teléfono</label>
                            <input type="text" name="nuevo_cliente_telefono" class="w-full p-2 bg-white border border-slate-300 rounded text-xs focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: 04241234567">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="flex flex-col gap-1">
                            <label class="block text-[10px] font-bold text-slate-600 uppercase">Tipo de Equipo</label>
                            <input type="text" name="nuevo_tipo_equipo" class="w-full p-2 bg-white border border-slate-300 rounded text-xs focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: Split / Nevera">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="block text-[10px] font-bold text-slate-600 uppercase">Marca del Equipo</label>
                            <input type="text" name="nuevo_marca_equipo" class="w-full p-2 bg-white border border-slate-300 rounded text-xs focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: Haier / LG">
                        </div>
                    </div>
                </div>

                <!-- SELECCIÓN DE EQUIPO EXISTENTE -->
                <div class="flex flex-col gap-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">O Seleccione Equipo Existente</label>
                    <select name="equipo_id" id="equipo_id" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Seleccione equipo a revisar...</option>
                        @if(isset($equipos) && count($equipos) > 0)
                            @foreach($equipos as $eq)
                                <option value="{{ $eq->id }}">{{ $eq->tipo_equipo }} - {{ $eq->marca }} ({{ $eq->cliente->nombre ?? 'Sin cliente' }})</option>
                            @endforeach
                        @else
                            <option value="" disabled>No hay equipos registrados (usa el registro rápido arriba)</option>
                        @endif
                    </select>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Tipo de Servicio</label>
                    <select name="tipo_servicio" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="Preventivo">Preventivo</option>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Instalación">Instalación</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div class="flex flex-col gap-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Presión Baja (PSI)</label>
                        <input type="number" step="0.1" name="presion_baja" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: 120">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Presión Alta (PSI)</label>
                        <input type="number" step="0.1" name="presion_alta" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: 350">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div class="flex flex-col gap-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Voltaje de Entrada (V)</label>
                        <input type="number" step="0.1" name="voltaje_entrada" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: 220">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="block text-xs font-bold text-slate-700 uppercase">Amperaje de Trabajo (A)</label>
                        <input type="number" step="0.1" name="amperaje_trabajo" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Ej: 8.5">
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Diagnóstico Técnico</label>
                    <textarea name="diagnostico_tecnico" rows="3" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Describa la falla o diagnóstico..." required></textarea>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Trabajo Realizado</label>
                    <textarea name="trabajo_realizado" rows="3" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Describa el trabajo ejecutado..." required></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold p-3 rounded-lg shadow transition mt-2">
                    Guardar y Generar Orden
                </button>
            </form>
        </main>
    </div>
</body>
</html>