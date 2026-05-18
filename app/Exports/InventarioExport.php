<?php

namespace App\Exports;

use App\Models\Herramienta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventarioExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Herramienta::selectRaw('nombre, marca, COUNT(*) as total, 
            SUM(CASE WHEN disponibilidad = "disponible" THEN 1 ELSE 0 END) as disp,
            SUM(CASE WHEN disponibilidad = "prestada" THEN 1 ELSE 0 END) as prest')
            ->groupBy('nombre', 'marca')
            ->get();
    }

    public function headings(): array {
        return ['Herramienta', 'Marca', 'Stock Total', 'Disponibles', 'Prestadas'];
    }
}
