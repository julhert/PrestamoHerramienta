<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrestamoDetalles extends Model
{
    protected $table = 'prestamo_detalles';

    protected $fillable = [
        'prestamo_id',
        'herramienta_id',
        'cantidad',
        'condicion_entrega',
        'condicion_devolucion'
    ];
}
