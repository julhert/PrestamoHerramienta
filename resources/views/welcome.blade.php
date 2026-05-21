<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Almacén y Préstamos - TSJ</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50 text-gray-900 flex flex-col min-h-screen">

    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-indigo-600 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <span class="font-bold text-xl text-gray-800 tracking-tight">Sistema de Prestamo y Gestión de Herramientas</span>
            </div>

            @if (Route::has('login'))
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">Ir al Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold bg-indigo-600 text-white px-5 py-2.5 rounded-md hover:bg-indigo-700 transition shadow-sm">Iniciar Sesión</a>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-bold bg-white text-indigo-600 border border-indigo-600 px-5 py-2.5 rounded-md hover:bg-indigo-50 transition shadow-sm">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
            
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
                Control de Inventario <br class="hidden sm:block"> 
                <span class="text-indigo-600">inteligente y seguro</span>
            </h1>
            
            <p class="mt-4 max-w-2xl text-lg sm:text-xl text-gray-500 mx-auto mb-10">
                Sistema centralizado para la gestión de herramientas, control de préstamos mediante código de barras y trazabilidad completa de tu almacén.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-indigo-700 shadow-lg transition-transform transform hover:-translate-y-0.5">
                        Ingresar al Sistema
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-indigo-700 shadow-lg transition-transform transform hover:-translate-y-0.5 flex items-center justify-center w-full sm:w-auto">
                        Iniciar Sesión
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-white text-indigo-600 border-2 border-indigo-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-indigo-50 shadow-lg transition-transform transform hover:-translate-y-0.5 flex items-center justify-center w-full sm:w-auto">
                            Crear Cuenta
                        </a>
                    @endif
                @endauth
            </div>

            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Escaneo Rápido</h3>
                    <p class="text-gray-500 text-sm">Registro de salidas y entradas en segundos utilizando tecnología de códigos QR o barras.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Auditoría Total</h3>
                    <p class="text-gray-500 text-sm">Historial inviolable con firmas digitales de los almacenistas en cada entrega y recepción.</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Reportes Precisos</h3>
                    <p class="text-gray-500 text-sm">Generación automática de reportes en PDF y Excel para el cierre de mes o revisiones físicas.</p>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <p>Sistema de Almacén diseñado para "Tecnológico Superior de Jalisco UA Lagos de Moreno"</p>
            <p class="mt-2 md:mt-0">Diseñado para la eficiencia operativa.</p>
        </div>
    </footer>

</body>
</html>