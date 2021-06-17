@extends('layouts.home')

@section('header')
<style>
            .search-sec{
                background: #1A4668;padding: 2rem;
            }
            .search-slt{
                display: block;
                width: 100%;
                font-size: 0.875rem;
                line-height: 1.5;
                color: #55595c;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                height: calc(3rem + 2px) !important;
                border-radius:0;
            }
            .wrn-btn{
                width: 100%;
                font-size: 16px;
                font-weight: 400;
                text-transform: capitalize;
                height: calc(3rem + 2px) !important;
                border-radius:0;
            }
            .dataTable-top {
            padding: 0 0 1rem !important;
                }
                    .dataTable-table {
                    border-collapse: collapse !important;
                }
                .dataTable-wrapper .dataTable-container {
                    font-size: 1.865rem;
                }

                tbody, td, tfoot, th, thead, tr {
                    /* border-color: inherit; */
                    border-style: solid;
                    border-color: rgba(0, 0, 0, 0.125);
                    border-width: 0;

                }
                .dataTables_wrapper .dataTables_filter {
                    float: right;
                    text-align: right;
                    margin-bottom: 10px;
                }
                .table > :not(:last-child) > :last-child > *, .dataTable-table > :not(:last-child) > :last-child > * {
                    border-bottom-color: currentColor;
                    border-bottom: none;
                }

        </style>
@endsection
@section('content')

    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col align-self-start"><i class="fas fa-table me-1"></i>List des fournisseur</div>
                <div class="col align-self-end " style="text-align: right !important;"><a class="btn btn-sm btn-secondary" href="#">Export fournisseur</a></div>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-sm dataTable-table" id="datatablesSimple">
                <thead style="background-color:#1A4668!important;"class="text-white">
                    <tr>
                        <th>Nom complet</th>

                        <th>Paye</th>
                        <th>Ville</th>
                        <th>Tel</th>
                        <th style='width:60px'>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($listfournisseur as $fournisseur)
                    <tr>
                        <td>{{$fournisseur->nom.' '.$fournisseur->prenom}}</td>
                        <td>{{$fournisseur->paye}}</td>
                        <td>{{$fournisseur->ville}}</td>
                        <td>{{$fournisseur->tel}}</td>
                        <td>
                            <form action="{{route('fournisseur.destroy',$fournisseur->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <a href="{{url('fournisseur/'.$fournisseur->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection

@section('script')
<script>
 $(document).ready(function() {
    $('#datatablesSimple').DataTable( {
        "language": {
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ éléments",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher :",
            "sZeroRecords":    "Aucun élément correspondant trouvé",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Précédent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            },
            "select": {
                    "rows": {
                        "_": "%d lignes sélectionnées",
                        "0": "Aucune ligne sélectionnée",
                        "1": "1 ligne sélectionnée"
                    }
	        }
        }
    } );
} );


</script>

@endsection
