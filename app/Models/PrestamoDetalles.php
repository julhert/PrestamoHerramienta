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

// Este detalle pertenece a una herramienta específica
    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }

    // Este detalle pertenece a un préstamo (ticket)
    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'prestamo_id');
    }
}
