<?php

namespace App\Exports;


use App\Models\Panel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class panelExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'fournisseur',
            'Ville',
            'Paye',
            'Tel',
            'Panel',
            'serveur',
            'Username',
        ];
    }
    public function collection()
    {
        return DB::table('four_panel')
        ->join('fournisseurs', 'four_panel.fournisseur_id', '=', 'fournisseurs.id')
        ->join('panels', 'four_panel.panel_id', '=', 'panels.id')
        ->select('fournisseurs.nom as nomm','fournisseurs.ville','fournisseurs.paye','fournisseurs.tel','panels.nom','panels.serveur','panels.username')
        ->get();
    }
}
