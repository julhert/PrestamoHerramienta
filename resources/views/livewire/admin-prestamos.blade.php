<div class="max-w-7xl mx-auto p-6 sm:px-6 lg:px-8 mt-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Control de Préstamos</h2>
    </x-slot>

    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        
        @if($mensajeExito)
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ $mensajeExito }}
            </div>
        @endif
        @if($mensajeError)
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded shadow-sm">
                {{ $mensajeError }}
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <input type="text" wire:model.live="search" placeholder="Buscar por alumno o número de control..." class="border-gray-300 rounded-md w-1/2 shadow-sm">
            <a href="{{ route('prestamos.nuevo') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow hover:bg-indigo-700 font-bold">
                + Nuevo Préstamo
            </a>
        </div>

        <div class="overflow-x-auto border rounded-lg shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prestatario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materia</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Herramientas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Salida</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Devolución</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($prestamos as $prestamo)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $prestamo->prestatario->nombre_completo }}</div>
                            <div class="text-xs text-gray-500">{{ $prestamo->prestatario->numero_control }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $prestamo->materia }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <ul class="list-disc list-inside">
                                @foreach($prestamo->detalles as $detalle)
                                    <li>{{ $detalle->cantidad }}x {{ $detalle->herramienta->nombre }} <span class="text-xs text-gray-400">({{ $detalle->herramienta->codigo_barras }})</span></li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if(is_null($prestamo->fecha_devolucion_real))
                                <button wire:click="marcarDevuelto({{ $prestamo->id }})" 
                                        wire:confirm="¿Estás seguro de que el alumno devolvió todas estas herramientas en buen estado?"
                                        class="bg-green-500 text-white px-3 py-1 rounded shadow hover:bg-green-600 text-sm font-semibold">
                                    Marcar Devuelto
                                </button>
                                <div class="text-xs text-red-500 mt-1 font-semibold">
                                    Límite: {{ \Carbon\Carbon::parse($prestamo->fecha_limite)->format('d/m/Y H:i') }}
                                </div>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Entregado el: {{ \Carbon\Carbon::parse($prestamo->fecha_devolucion_real)->format('d/m/Y H:i') }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No hay registros de préstamos.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>