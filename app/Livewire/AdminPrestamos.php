<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Prestamo;
use App\Models\Herramienta; // Importante para actualizar el inventario
use Illuminate\Support\Facades\DB; // Importante para transacciones seguras

#[Layout('layouts.app')]
class AdminPrestamos extends Component
{
    public $search = '';
    public $mensajeExito = '';
    public $mensajeError = '';

    public function marcarDevuelto($prestamoId)
    {
        $this->mensajeExito = '';
        $this->mensajeError = '';

        try {
            DB::transaction(function () use ($prestamoId) {
                // Buscamos el préstamo junto con sus detalles
                $prestamo = Prestamo::with('detalles')->findOrFail($prestamoId);

                // 1. Actualizar el ticket de préstamo
                $prestamo->update([
                    'fecha_devolucion_real' => now(),
                    'estado_prestamo' => 'devuelto',
                ]);

                // 2. Recorrer las herramientas de este préstamo y liberarlas
                foreach ($prestamo->detalles as $detalle) {
                    Herramienta::where('id', $detalle->herramienta_id)
                        ->update(['disponibilidad' => 'disponible']);
                }
            });

            $this->mensajeExito = '¡Las herramientas han sido devueltas al inventario exitosamente!';

        } catch (\Exception $e) {
            $this->mensajeError = 'Ocurrió un error al registrar la devolución: ' . $e->getMessage();
        }
    }

    public function render()
    {
        // Traemos los préstamos ordenados para ver los más recientes primero
        $prestamos = Prestamo::with(['prestatario', 'detalles.herramienta'])
            ->whereHas('prestatario', function($query) {
                $query->where('nombre_completo', 'like', '%'.$this->search.'%')
                      ->orWhere('numero_control', 'like', '%'.$this->search.'%');
            })
            ->orderBy('fecha_prestamo', 'desc')
            ->get();

        return view('livewire.admin-prestamos', compact('prestamos'));
    }
}