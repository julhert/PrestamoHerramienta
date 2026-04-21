<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Prestatario;

#[Layout('layouts.app')]
class AdminUsuarios extends Component
{
    public $search = '';
    public $modalAbierto = false;
    
    // Variables del formulario
    public $id_usuario;
    public $numero_control, $nombre_completo, $tipo_usuario, $carrera_departamento;
    public $semestre, $grupo, $telefono, $estado;

    public function abrirModal() 
    { 
        $this->resetInput(); 
        $this->modalAbierto = true; 
    }

    public function cerrarModal() 
    { 
        $this->modalAbierto = false; 
    }

    public function resetInput() 
    {
        $this->id_usuario = null;
        $this->numero_control = '';
        $this->nombre_completo = '';
        $this->tipo_usuario = 'Alumno'; // Valor por defecto
        $this->carrera_departamento = '';
        $this->semestre = '';
        $this->grupo = '';
        $this->telefono = '';
        $this->estado = 'activo';
    }

    public function guardar()
    {
        Prestatario::updateOrCreate(['id' => $this->id_usuario], [
            'numero_control' => $this->numero_control,
            'nombre_completo' => $this->nombre_completo,
            'tipo_usuario' => $this->tipo_usuario,
            'carrera_departamento' => $this->carrera_departamento,
            'semestre' => $this->semestre,
            'grupo' => $this->grupo,
            'telefono' => $this->telefono,
            'estado' => $this->estado,
        ]);
        
        $this->cerrarModal();
    }

    public function editar($id)
    {
        $usuario = Prestatario::findOrFail($id);
        $this->id_usuario = $id;
        $this->numero_control = $usuario->numero_control;
        $this->nombre_completo = $usuario->nombre_completo;
        $this->tipo_usuario = $usuario->tipo_usuario;
        $this->carrera_departamento = $usuario->carrera_departamento;
        $this->semestre = $usuario->semestre;
        $this->grupo = $usuario->grupo;
        $this->telefono = $usuario->telefono;
        $this->estado = $usuario->estado;
        
        $this->modalAbierto = true;
    }

    public function borrar($id) 
    { 
        Prestatario::find($id)->delete(); 
    }

    public function render()
    {
        $usuarios = Prestatario::where('nombre_completo', 'like', '%' . $this->search . '%')
            ->orWhere('numero_control', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->get();
            
        return view('livewire.admin-usuarios', compact('usuarios'));
    }
}