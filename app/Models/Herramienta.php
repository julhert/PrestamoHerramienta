<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    protected $table = 'herramientas';

    protected $fillable = [
        'codigo_barras',
        'nombre',
        'marca',
        'descripcion_equipo',
        'categoria_id',
        'estado_fisico',
        'disponibilidad',
        'observaciones'
    ];
}
