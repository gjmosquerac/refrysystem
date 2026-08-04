@extends('layouts.app') {{-- O el layout que utilices --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Panel de Órdenes y Solicitudes</h1>
        <a href="{{ route('ordenes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            + Nueva Orden Manual
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Orden / Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente / Teléfono</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equipo / Falla</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estatus / Trabajo</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($ordenes as $orden)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #000{{ $orden->id }}
                            <div class="text-xs text-gray-500">{{ $orden->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            <div class="font-bold">{{ $orden->equipo->cliente->nombre ?? 'Sin cliente' }}</div>
                            <div class="text-xs text-gray-500">{{ $orden->equipo->cliente->telefono ?? 'Sin teléfono' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <div class="font-semibold">{{ $orden->equipo->tipo_equipo ?? 'Equipo' }} ({{ $orden->equipo->marca ?? 'N/D' }})</div>
                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ $orden->diagnostico_tecnico }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if(str_contains($orden->trabajo_realizado, 'Pendiente por revisión'))
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Solicitud Web (Pendiente)
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Completado
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('ordenes.create', ['equipo_id' => $orden->equipo_id]) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded mr-2">
                                Atender / Cargar Presiones
                            </a>
                            <a href="{{ route('ordenes.whatsapp', $orden->id) }}" target="_blank" class="text-green-600 hover:text-green-900 bg-green-50 px-3 py-1 rounded">
                                WhatsApp
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            No hay órdenes ni solicitudes registradas todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection