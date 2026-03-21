<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestatario extends Model
{
    protected $table = 'prestatarios';

    protected $fillable = [
        'numero_control',
        'nombre_completo',
        'tipo_usuario',
        'carrera_departamento',
        'semestre',
        'grupo',
        'telefono',
        'estado'
    ];
}
