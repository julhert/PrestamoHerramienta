<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\MisPrestamos;
use App\Livewire\AdminPrestamos;
use App\Livewire\AdminHerramientas;
use App\Livewire\AdminUsuarios;
use App\Livewire\NuevoPrestamo;
use App\Livewire\AdminInventario;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

// Ruta para usuarios normales
Route::get('/mis-prestamos', MisPrestamos::class)->name('mis.prestamos');

// Rutas para administradores
Route::get('/admin/prestamos', AdminPrestamos::class)->name('admin.prestamos');
Route::get('/admin/prestamos/nuevo', NuevoPrestamo::class)->name('prestamos.nuevo');
Route::get('/admin/herramientas', AdminHerramientas::class)->name('admin.herramientas');
Route::get('/admin/usuarios', AdminUsuarios::class)->name('admin.usuarios');
Route::get('/admin/inventario', AdminInventario::class)->name('admin.inventario');
});
