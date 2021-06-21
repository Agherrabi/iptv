<?php

namespace App\Exports;


use App\Models\Panel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class fourExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nom',
            'Ville',
            'Paye',
            'Tel',


        ];
    }
    public function collection()
    {
        return Panel::select('nom','ville','paye','tel')->get();
    }
}
