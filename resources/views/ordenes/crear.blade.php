<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RefriSystem - Campo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Equipo / Cliente</label>
                    <div class="flex gap-2">
                        <select name="equipo_id" id="equipo_id" class="w-full p-3 bg-slate-50 border border-slate-300 rounded-xl text-sm" required>
                            <option value="">Seleccione equipo a revisar...</option>
                            @foreach($equipos as $eq)
                                <option value="{{ $eq->id }}">{{ $eq->tipo_equipo }} - {{ $eq->marca }} ({{ $eq->cliente->nombre ?? 'Sin cliente' }})</option>
                            @endforeach
                        </select>
                        
                        <!-- Botón para abrir el modal rápido -->
                        <button type="button" onclick="toggleModal(true)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-xl shadow transition flex items-center justify-center shrink-0">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Tipo de Servicio</label>
                    <select name="tipo_servicio" class="w-full mt-1 p-3 bg-slate-50 border border-slate-300 rounded-xl text-sm" required>
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

    <!-- MODAL DE REGISTRO RÁPIDO -->
    <div id="modalNuevo" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden flex flex-col">
            <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
                <h3 class="font-bold text-sm uppercase tracking-wider">Nuevo Cliente / Equipo</h3>
                <button type="button" onclick="toggleModal(false)" class="text-white hover:text-slate-200 text-lg">&times;</button>
            </div>
            
            <form id="formFastStore" class="p-4 space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Nombre del Cliente</label>
                    <input type="text" id="fast_nombre" name="nombre" class="w-full mt-1 p-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm" required placeholder="Ej. Juan Pérez">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Ubicación / Sede</label>
                    <input type="text" id="fast_ubicacion" name="ubicacion" class="w-full mt-1 p-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm" required placeholder="Ej. Com. La Coromoto">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Tipo de Equipo</label>
                    <input type="text" id="fast_tipo" name="tipo_equipo" class="w-full mt-1 p-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm" required placeholder="Ej. Cava Cuarto / Split">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase">Marca</label>
                    <input type="text" id="fast_marca" name="marca" class="w-full mt-1 p-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm" required placeholder="Ej. Carrier / Haier">
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="button" onclick="toggleModal(false)" class="w-1/2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-3 rounded-xl text-sm transition">Cancelar</button>
                    <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl text-sm transition shadow">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script de control para el modal y AJAX -->
    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modalNuevo');
            if (show) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        document.getElementById('formFastStore').addEventListener('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('clientes.store.fast') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    let select = document.getElementById('equipo_id');
                    let option = document.createElement('option');
                    option.value = data.equipo.id;
                    option.text = data.equipo.tipo_equipo + ' - ' + data.equipo.marca + ' (' + data.cliente.nombre + ')';
                    option.selected = true;
                    select.add(option);

                    toggleModal(false);
                    this.reset();
                } else {
                    alert('Hubo un error al registrar.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error de conexión.');
            });
        });
    </script>
</body>
</html>