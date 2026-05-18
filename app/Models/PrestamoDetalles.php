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
        'condicion_devolucion',
        'entregado_por_id',
        'recibido_por_id'
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

    // Relación para saber quién autorizó/registró la salida en el sistema
    public function entregadoPor()
    {
        return $this->belongsTo(User::class, 'entregado_por_id');
    }

    // Relación para saber qué almacenista entregó físicamente la herramienta
    public function recibidoPor()
    {
        return $this->belongsTo(User::class, 'recibido_por_id');
    }
}
