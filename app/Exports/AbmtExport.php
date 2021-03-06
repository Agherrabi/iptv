<?php

namespace App\Exports;

use App\Models\Pack;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbmtExport implements FromCollection, WithHeadings,WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */


    public function __construct(String $nom = null,int $abonnement = null,String $status = null,String $statusP = null,String $date_d = null,String $date_f = null)
    {
        $this->nom = $nom;
        $this->abonnement = $abonnement;
        $this->status = $status;
        $this->statusP = $statusP;
        $this->date_d = $date_d;
        $this->date_f = $date_f;

    }
    public function collection()
     {

        $query = DB::table('clients')
        ->join('packs', 'packs.client_id', '=', 'clients.id')
        ->select('nom', 'prenom', 'abonnement','ville', 'paye','tel','adress_mac','date_creation','date_experation','status','forniceur','panel',
        'serveur','username','prix','avence','reste','status_paiment','moyen_paiment','m3u','remarque');
        if (isset($this->nom))
        $query=$query->where('nom', 'LIKE', $this->nom);
        if (isset($this->abonnement))
        $query=$query->where('abonnement', 'LIKE', $this->abonnement);
        if (isset($this->status))
        $query=$query->where('status', 'LIKE', $this->status);
        if (isset($this->statusP))
        $query=$query->where('status_paiment', '=', $this->statusP);
        if (isset( $this->date_d))
        $query=$query->whereBetween('date_experation',[$this->date_d,$this->date_f]);

        return $listpack =$query->get();

        //   DB::table('packs')->select()->where('status','LIKE',$this->status)->get();
     }
    public function headings(): array
    {
        return [
            'Nom',
            'Prenom',
            'N Abmt',
            'Ville',
            'Paye',
            'Tel',
            'Adress Mac',
            'date_creation',
            'date_experation',
            'Status',
            'Fournisseur',
            'Panel',
            'Serveur',
            'Username',
            'Prix',
            'Montant Pay??',
            'Reste',
            'Status Paiment',
            'Moyen Paiment',
            'M3U',
            'Remarque',



        ];
    }



    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],



            // Styling a specific cell by coordinate.


            // Styling an entire column.

        ];

    }

}
