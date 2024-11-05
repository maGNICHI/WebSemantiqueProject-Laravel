<?php

namespace App\Exports;

use App\Models\Reclamation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReclamationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Reclamation::all(); // Vous pouvez filtrer les réclamations si nécessaire
    }

    public function headings(): array
    {
        return [
            'ID',
            'Sujet',
            'Description',
            'User ID',
            'État',
            'Créé à',
            'Mis à jour à'
        ];
    }
}
