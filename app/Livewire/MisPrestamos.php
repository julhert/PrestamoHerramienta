<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Prestamo;
use App\Models\Prestatario;

#[Layout('layouts.app')]
class MisPrestamos extends Component
{
    public function render()
    {
        // Buscamos al prestatario asociado a este usuario logueado (puedes buscar por email o crear una relación)
        $prestatario = Prestatario::where('numero_control', auth()->user()->email)->first(); 

        $prestamos = [];
        if($prestatario) {
            $prestamos = Prestamo::with('detalles.herramienta')
                ->where('prestatario_id', $prestatario->id)
                ->orderBy('fecha_prestamo', 'desc')
                ->get();
        }

        return view('livewire.mis-prestamos', compact('prestamos'));
    }
}