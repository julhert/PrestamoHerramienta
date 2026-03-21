<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';

    protected $fillable = [
        'prestatario_id',
        'user_id',
        'materia',
        'fecha_prestamo',
        'fecha_limite',
        'fecha_devolucion_real',
        'acepto_terminos',
        'estado_prestamo'
    ];
}
