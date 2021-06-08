<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nom',
            'Prenom',
            'Tel',
            'Paye',
            'Ville',
        ];
    }
    public function collection()
    {
        return Client::select('nom','prenom','tel','paye','ville')->get();
    }
}
