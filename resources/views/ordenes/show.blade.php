<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden #{{ $orden->id }} - LeoTec Refrigeración</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .max-w-md { max-width: 100% !important; shadow: none !important; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-xl flex flex-col p-4 space-y-4">
        <!-- Encabezado de la Marca -->
        <div class="text-center border-b pb-3">
            <h1 class="font-bold text-xl text-blue-600">❄️ LeoTec Refrigeración</h1>
            <p class="text-xs text-slate-500 font-semibold">Servicio Técnico Especializado • Carora</p>
            <p class="text-xs text-slate-400 mt-0.5">Reporte de Intervención N°: 000{{ $orden->id }}</p>
        </div>

        <!-- Datos del Técnico Responsable -->
        <div class="bg-blue-50 border border-blue-100 p-2.5 rounded-xl text-xs space-y-0.5">
            <p class="font-bold text-blue-900">👨‍🔧 Técnico: Leonardo Mosquera</p>
            <p class="text-blue-800">🪪 <strong>Cédula:</strong> V-19.149.673 | 📱 <strong>Contacto:</strong> +58 424-5652208</p>
            <p class="text-blue-800">📍 <strong>Ubicación:</strong> Carora, Estado Lara</p>
        </div>

        <!-- Datos del Cliente y Equipo -->
        <div class="bg-slate-50 p-3 rounded-xl border text-xs space-y-1">
            <p><strong>Cliente:</strong> {{ $orden->equipo->cliente->nombre ?? 'N/D' }}</p>
            <p><strong>Teléfono:</strong> {{ $orden->equipo->cliente->telefono ?? 'N/D' }}</p>
            <p><strong>Dirección:</strong> {{ $orden->equipo->cliente->direccion ?? 'N/D' }}</p>
            
            <!-- Botones de Comunicación Rápida (WhatsApp y Llamada - No salen al imprimir) -->
            <div class="no-print flex gap-2 pt-2">
                <a href="https://wa.me/{{ $orden->equipo->cliente->telefono ?? '' }}" target="_blank" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white text-center font-bold py-1.5 px-2 rounded-lg text-[11px] flex items-center justify-center gap-1 shadow">
                    💬 WhatsApp
                </a>
                <a href="tel:{{ $orden->equipo->cliente->telefono ?? '' }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-1.5 px-2 rounded-lg text-[11px] flex items-center justify-center gap-1 shadow">
                    📞 Llamar
                </a>
            </div>

            <hr class="my-1 border-slate-200">
            <p><strong>Equipo:</strong> {{ $orden->equipo->tipo_equipo }} - {{ $orden->equipo->marca }} ({{ $orden->equipo->modelo }})</p>
            <p><strong>Refrigerante:</strong> {{ $orden->equipo->refrigerante }}</p>
            <p><strong>Ubicación:</strong> {{ $orden->equipo->ubicacion_especifica }}</p>
        </div>

        <!-- Parámetros Técnicos Medidos -->
        <div class="border rounded-xl p-3 space-y-2">
            <h4 class="text-xs font-bold uppercase text-slate-700">Parámetros Operativos</h4>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div class="bg-slate-50 p-2 rounded">Presión Baja: <strong>{{ $orden->presion_baja ?? 'N/A' }} PSI</strong></div>
                <div class="bg-slate-50 p-2 rounded">Presión Alta: <strong>{{ $orden->presion_alta ?? 'N/A' }} PSI</strong></div>
                <div class="bg-slate-50 p-2 rounded">Voltaje: <strong>{{ $orden->voltaje_entrada ?? 'N/A' }} V</strong></div>
                <div class="bg-slate-50 p-2 rounded">Amperaje: <strong>{{ $orden->amperaje_trabajo ?? 'N/A' }} A</strong></div>
            </div>
        </div>

        <!-- Diagnóstico y Trabajo -->
        <div class="space-y-3 text-xs">
            <div>
                <h4 class="font-bold uppercase text-slate-700">Diagnóstico Técnico:</h4>
                <p class="bg-slate-50 p-3 rounded-xl border mt-1">{{ $orden->diagnostico_tecnico }}</p>
            </div>
            <div>
                <h4 class="font-bold uppercase text-slate-700">Trabajo Realizado:</h4>
                <p class="bg-slate-50 p-3 rounded-xl border mt-1">{{ $orden->trabajo_realizado }}</p>
            </div>
        </div>

        <!-- Resumen de Costos, Tasa BCV y Métodos de Pago -->
        <div class="border rounded-xl p-3 space-y-3 bg-slate-50 text-xs">
            <h4 class="font-bold uppercase text-slate-800 border-b border-slate-200 pb-1">Resumen de Facturación y Pagos</h4>
            
            <div class="space-y-1">
                <div class="flex justify-between text-slate-700">
                    <span>Mano de Obra / Servicio:</span>
                    <span>$ 30.00</span>
                </div>
                <div class="flex justify-between text-slate-700">
                    <span>Repuestos / Materiales:</span>
                    <span>$ 15.00</span>
                </div>
                <hr class="border-slate-200 my-1">
                <div class="flex justify-between text-sm font-bold text-blue-700">
                    <span>TOTAL A PAGAR (USD):</span>
                    <span>$ 45.00</span>
                </div>
            </div>

            <!-- Conversión BCV Simulada -->
            <div class="bg-blue-50 border border-blue-200 p-2.5 rounded-lg space-y-1">
                <div class="flex justify-between text-blue-900 font-semibold">
                    <span>Tasa BCV Referencia:</span>
                    <span>36.50 VES/$</span>
                </div>
                <div class="flex justify-between text-blue-900 font-bold text-sm">
                    <span>TOTAL EN BOLÍVARES (VES):</span>
                    <span>Bs. 1,642.50</span>
                </div>
            </div>

            <!-- Métodos de Pago Disponibles (Sin transferencias) -->
            <div class="space-y-2 pt-1">
                <p class="font-bold uppercase text-slate-700 tracking-wide text-[11px] border-b border-slate-200 pb-1">Métodos de Pago Disponibles</p>
                <div class="grid grid-cols-1 gap-2 text-[11px]">
                    
                    <!-- Pago Móvil -->
                    <div class="bg-white p-2.5 rounded-xl border border-slate-200 shadow-sm space-y-1">
                        <div class="flex items-center gap-1.5 font-bold text-slate-800">
                            <span>📱</span> <span>Pago Móvil:</span>
                        </div>
                        <div class="text-slate-600 pl-5 space-y-0.5">
                            <p>• <strong>Banco Provincial (0108):</strong> 0424-5652208 — V-19.149.673</p>
                            <p>• <strong>Banco de Venezuela (0102):</strong> 0424-5652208 — V-19.149.673</p>
                        </div>
                    </div>

                    <!-- Divisa en Efectivo -->
                    <div class="bg-white p-2.5 rounded-xl border border-slate-200 shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-1.5 font-bold text-slate-800">
                            <span>💵</span> <span>Divisa en Efectivo:</span>
                        </div>
                        <span class="bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded border border-emerald-200">USD / EUR</span>
                    </div>

                </div>
            </div>
        </div>
            
        <!-- Botones de Acción (No salen al imprimir) -->
        <div class="no-print pt-2 space-y-2">
            <!-- Botón Automatizado de WhatsApp hacia el Cliente -->
            <a href="{{ route('ordenes.whatsapp', $orden->id) }}" target="_blank" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-xl shadow text-xs uppercase tracking-wider flex items-center justify-center gap-1.5 transition-all">
                <span>💬</span> Enviar Reporte al WhatsApp del Cliente
            </a>

            <!-- Botón Imprimir PDF -->
            <button onclick="window.print()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow text-xs uppercase tracking-wider">
                🖨️ Imprimir / Guardar PDF
            </button>

            <!-- Botón Volver -->
            <a href="{{ route('ordenes.index') }}" class="block text-center w-full bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold py-3 rounded-xl text-xs uppercase tracking-wider">
                ← Volver al Historial
            </a>
        </div>
    </div>

</body>
</html>