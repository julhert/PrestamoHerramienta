<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido al Sistema de Préstamo de Herramientas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">¡Hola, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-600 text-lg">
                    Te damos la bienvenida al sistema del almacén. Por favor, utiliza las opciones del menú superior para navegar.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>