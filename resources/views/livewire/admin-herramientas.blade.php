<div class="max-w-7xl mx-auto p-6 sm:px-6 lg:px-8 mt-8">
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Inventario de Herramientas</h2></x-slot>

    <div class="bg-white shadow-xl sm:rounded-lg p-6">
        <div class="flex justify-between mb-4">
            <input type="text" wire:model.live="search" placeholder="Buscar herramienta o código..." class="border-gray-300 rounded-md w-1/3 shadow-sm">
            <button wire:click="abrirModal" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 font-bold">
                + Nueva Herramienta
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase font-bold">QR / Código</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase font-bold">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase font-bold">Marca</th>
                        <th class="px-6 py-3 text-left text-xs text-gray-500 uppercase font-bold">Estado</th>
                        <th class="px-6 py-3 text-center text-xs text-gray-500 uppercase font-bold">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($herramientas as $h)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-mono text-gray-900">{{ $h->codigo_barras }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $h->nombre }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $h->marca }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $h->disponibilidad === 'disponible' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($h->disponibilidad) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-sm font-medium space-x-3">
                            <button wire:click="mostrarQr({{ $h->id }})" class="text-gray-600 hover:text-gray-900 font-bold">Ver QR</button>
                            <button wire:click="editar({{ $h->id }})" class="text-indigo-600 hover:text-indigo-900 font-bold">Editar</button>
                            <button wire:click="borrar({{ $h->id }})" wire:confirm="¿Estás seguro de eliminar esta herramienta?" class="text-red-600 hover:text-red-900 font-bold">Borrar</button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay herramientas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($modalAbierto)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-bold text-gray-800">{{ $id_herramienta ? 'Editar' : 'Nueva' }} Herramienta</h3>
            </div>
            
            <div class="p-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Código de Barras / QR</label>
                <input type="text" wire:model="codigo_barras" placeholder="Ej. HERR-001" class="w-full mb-3 border-gray-300 rounded shadow-sm">
                
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" wire:model="nombre" placeholder="Nombre de herramienta" class="w-full mb-3 border-gray-300 rounded shadow-sm">
                
                <label class="block text-sm font-medium text-gray-700 mb-1">Marca</label>
                <input type="text" wire:model="marca" placeholder="Marca" class="w-full mb-3 border-gray-300 rounded shadow-sm">
                
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado / Disponibilidad</label>
                <select wire:model="disponibilidad" class="w-full mb-4 border-gray-300 rounded shadow-sm">
                    <option value="disponible">Disponible</option>
                    <option value="prestada">Prestada</option>
                    <option value="mantenimiento">Mantenimiento</option>
                </select>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t flex justify-end space-x-2">
                <button wire:click="cerrarModal" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 shadow-sm font-medium">Cancelar</button>
                <button wire:click="guardar" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 shadow-sm font-medium">Guardar</button>
            </div>
        </div>
    </div>
    @endif

    @if($modalQrAbierto && $herramientaSeleccionada)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-sm overflow-hidden text-center p-6">
            
            <h3 class="text-xl font-bold text-gray-800">{{ $herramientaSeleccionada->nombre }}</h3>
            <p class="text-sm text-gray-500 mb-4">{{ $herramientaSeleccionada->marca }}</p>

            <div id="zona-impresion-qr" class="flex flex-col items-center justify-center p-4 bg-white">
                {!! $this->generarQrSvg($herramientaSeleccionada->codigo_barras) !!}
                <p class="mt-2 text-md font-mono font-bold text-black">{{ $herramientaSeleccionada->codigo_barras }}</p>
            </div>

            <div class="mt-6 flex justify-center space-x-3">
                <button wire:click="cerrarModalQr" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 font-medium">
                    Cerrar
                </button>
                <button onclick="imprimirQR()" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-medium flex items-center">
                    Imprimir Etiqueta
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        function imprimirQR() {
            let contenido = document.getElementById('zona-impresion-qr').innerHTML;
            let ventana = window.open('', '', 'width=300,height=400');
            
            ventana.document.write('<html><head><title>Etiqueta QR</title>');
            ventana.document.write('<style>');
            
            // Cambia '80mm' por '58mm' si tu impresora es de las pequeñas
            ventana.document.write('@page { size: 80mm auto; margin: 0mm; }'); 
            
            ventana.document.write('body { ');
            ventana.document.write('  margin: 0; padding: 10px 0; ');
            ventana.document.write('  font-family: monospace; text-align: center; ');
            ventana.document.write('  width: 100%; display: flex; flex-direction: column; align-items: center; ');
            ventana.document.write('}');
            ventana.document.write('svg { width: 45mm; height: 45mm; }'); 
            ventana.document.write('p { margin-top: 5px; font-size: 14px; font-weight: bold; margin-bottom: 0; }');
            ventana.document.write('</style>');
            ventana.document.write('</head><body>');
            
            ventana.document.write('<div>' + contenido + '</div>');
            
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.focus();
            
            setTimeout(() => {
                ventana.print();
                ventana.close();
            }, 500);
        }
    </script>
</div>