@extends('layouts.home')

@section('content')
    <div class="card mb-4">
            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif
            <div class="card-header d-flex">
            <div class="p-2"><i class="fas fa-table me-1 "></i>
            List des user</div>
        </div>
        <div class="card-body">
            <table class="table table-sm dataTable-table" id="datatablesSimple">
                <thead  style="background-color:#1A4668!important;"class="text-white">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style='max-width:60px'>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($listuser as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->is_admin == 1) Admin @else user @endif</td>
                        <td>
                            <form action="{{route('userdelete',$user->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <a href="{{url('useredit/'.$user->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script>
 $(document).ready(function() {
    $('#datatablesSimple').DataTable( {
        "language": {
            "sEmptyTable":     "Aucune donn??e disponible dans le tableau",
            "sInfo":           "Affichage de l'??l??ment _START_ ?? _END_ sur _TOTAL_ ??l??ments",
            "sInfoEmpty":      "Affichage de l'??l??ment 0 ?? 0 sur 0 ??l??ment",
            "sInfoFiltered":   "(filtr?? ?? partir de _MAX_ ??l??ments au total)",
            "sInfoThousands":  ",",
            "sLengthMenu":     "Afficher _MENU_ ??l??ments",
            "sLoadingRecords": "Chargement...",
            "sProcessing":     "Traitement...",
            "sSearch":         "Rechercher :",
            "sZeroRecords":    "Aucun ??l??ment correspondant trouv??",
            "oPaginate": {
                "sFirst":    "Premier",
                "sLast":     "Dernier",
                "sNext":     "Suivant",
                "sPrevious": "Pr??c??dent"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre d??croissant"
            },
            "select": {
                    "rows": {
                        "_": "%d lignes s??lectionn??es",
                        "0": "Aucune ligne s??lectionn??e",
                        "1": "1 ligne s??lectionn??e"
                    }
	        }
        }
    } );
} );


</script>

@endsection
