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

    // --- NUEVAS RELACIONES ---

    // Un préstamo pertenece a un prestatario (alumno/trabajador)
    public function prestatario()
    {
        return $this->belongsTo(Prestatario::class, 'prestatario_id');
    }

    // Un préstamo tiene muchos detalles (las herramientas que se llevó)
    public function detalles()
    {
        return $this->hasMany(PrestamoDetalles::class, 'prestamo_id');
    }

    // Opcional, pero recomendado: Un préstamo fue registrado por un usuario (almacenista)
    public function almacenista()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
