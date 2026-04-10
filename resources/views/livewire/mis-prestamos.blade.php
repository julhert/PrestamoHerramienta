<div class="max-w-7xl mx-auto p-6 sm:px-6 lg:px-8 mt-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mis Préstamos</h2>
    </x-slot>

    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <table class="min-w-full divide-y divide-gray-200 mb-6">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Herramientas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($prestamos as $prestamo)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prestamo->fecha_prestamo }}</td>
                    <td class="px-6 py-4">
                        @foreach($prestamo->detalles as $detalle)
                            • {{ $detalle->herramienta->nombre }} (Cant: {{ $detalle->cantidad }}) <br>
                        @endforeach
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $prestamo->estado_prestamo }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">
            Regresar
        </a>
    </div>
</div>