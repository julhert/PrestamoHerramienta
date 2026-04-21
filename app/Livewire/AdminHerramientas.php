<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Herramienta;

#[Layout('layouts.app')]
class AdminHerramientas extends Component
{
    // Variables del buscador y CRUD
    public $search = '';
    public $modalAbierto = false;
    public $id_herramienta, $codigo_barras, $nombre, $marca, $estado_fisico, $disponibilidad;

    // Variables exclusivas para el QR
    public $modalQrAbierto = false;
    public $herramientaSeleccionada = null;

    // --- FUNCIONES DEL CRUD DE HERRAMIENTAS ---
    public function abrirModal() { $this->resetInput(); $this->modalAbierto = true; }
    public function cerrarModal() { $this->modalAbierto = false; }
    
    public function resetInput() {
        $this->id_herramienta = null; $this->codigo_barras = ''; $this->nombre = ''; 
        $this->marca = ''; $this->estado_fisico = ''; $this->disponibilidad = 'disponible';
    }

    public function guardar()
    {
        Herramienta::updateOrCreate(['id' => $this->id_herramienta], [
            'codigo_barras' => $this->codigo_barras,
            'nombre' => $this->nombre,
            'marca' => $this->marca,
            'estado_fisico' => $this->estado_fisico,
            'disponibilidad' => $this->disponibilidad,
        ]);
        $this->cerrarModal();
    }

    public function editar($id)
    {
        $h = Herramienta::findOrFail($id);
        $this->id_herramienta = $id;
        $this->codigo_barras = $h->codigo_barras;
        $this->nombre = $h->nombre;
        $this->marca = $h->marca;
        $this->estado_fisico = $h->estado_fisico;
        $this->disponibilidad = $h->disponibilidad;
        $this->modalAbierto = true;
    }

    public function borrar($id) { Herramienta::find($id)->delete(); }

    // --- FUNCIONES DEL CÓDIGO QR ---
    public function mostrarQr($id)
    {
        $this->herramientaSeleccionada = Herramienta::find($id);
        $this->modalQrAbierto = true;
    }

    public function cerrarModalQr()
    {
        $this->modalQrAbierto = false;
        $this->herramientaSeleccionada = null;
    }

    public function generarQrSvg($codigo)
    {
        // Usa la librería nativa de Jetstream (BaconQrCode)
        $renderer = new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(200, 1),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new \BaconQrCode\Writer($renderer);
        
        return $writer->writeString($codigo);
    }

    // --- RENDER DE LA VISTA ---
    public function render()
    {
        $herramientas = Herramienta::where('nombre', 'like', '%'.$this->search.'%')
                        ->orWhere('codigo_barras', 'like', '%'.$this->search.'%')
                        ->get();
                        
        return view('livewire.admin-herramientas', compact('herramientas'));
    }
}