
@extends('layouts.home')
@section('content')
<?php
use Carbon\Carbon;
?>

    <div class="card mb-4">


    <section class="search-sec">
        <div class="container">
            <form action="{{route('recherch')}}" method="post" >
            {{csrf_field()}}
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <input type="text" name="nom" class="form-control search-slt" value="{{ $nom ?? '' }}"placeholder="Client">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <input type="text" name="abonnement" class="form-control search-slt" value="{{ $abonnement ?? '' }}" placeholder="N d'Abonnement">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <select class="form-control search-slt" name="status" >
                                    <option value="">Etat </option>
                                    <option value="active" @if(!empty($status) && $status == 'active')  selected @endif>Active</option>
                                    <option value="expiré" @if(!empty($status) && $status == 'expiré')   selected @endif>Expiré</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <select class="form-control search-slt" name="statusP" >
                                    <option value="">Statut de paiement </option>
                                    <option value="n" @if(!empty($statusP) && $statusP == 'n')   selected @endif>Non Payé</option>
                                    <option value="a" @if(!empty($statusP) && $statusP == 'a')   selected @endif>Avance</option>
                                    <option value="p" @if(!empty($statusP) && $statusP == 'p')   selected @endif>Payé</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                <button type="submit" class="btn btn-danger wrn-btn" name="Rechercher">Rechercher</button>
                            </div>

                            <div class="collapse" id="collapseExample">

                          {{-- <div class="row">
                                <div class="col-6 ">
                                    <label class="sr-only" for="inlineFormInputGroup">date d</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend ">
                                            <div class="input-group-text p-2">Date Début</div>
                                        </div>
                                        <input type="date" name="date_d" class="form-control p-2" id="inlineFormInputGroup" value="{{ $date_d ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="sr-only" for="inlineFormInputGroup">date f</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text p-2">Date Fin</div>
                                        </div>
                                        <input type="date" name="date_f" class="form-control" id="inlineFormInputGroup" value="{{ $date_f ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    </div>
                </div>

                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                            <div class="input-group-prepend ">
                                            <label class="text-white">Date Début</label>
                                        </div>
                            <input type="date" name="date_d" class="form-control search-slt" value="{{ $date_d ?? '' }}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 p-0">
                            <div class="input-group-prepend ">
                                            <label class="text-white">Date Fin</label>
                                        </div>
                                <input type="date" name="date_f" class="form-control search-slt" value="{{ $date_f ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-sm btn-secondary" name="abmtExport">Export Abonnement</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="card-header ">
           <div class="">
                <i class="fas fa-table me-1"></i>
                List des abonnements
            </div>
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-sm dataTable-table" id="datatablesSimple" >
                    <thead style="background-color:#1A4668!important;"class="text-white">
                        <tr>
                            <th>Client</th>
                            <th>N Abm</th>
                            <th >Jours Reste</th>
                            <th>status</th>
                            <th>Prix</th>
                            <th>Avance</th>
                            <th>Reste</th>
                            <th>Paiement</th>
                            <th style="min-width:100px !important">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($listpack as $pack)
                        <tr>
                            <td>{{$pack->nom.' '.$pack->prenom}}</td>
                            <td>{{$pack->abonnement}}</td>
                            <td>@if($pack->date_experation < Carbon::now()) @if(Carbon::parse($pack->date_experation)->diffInDays(Carbon::now()) != 0) - @endif     @endif {{Carbon::parse($pack->date_experation)->diffInDays(Carbon::now())}}</td>
                            <td>{{$pack->status}}</td>
                            <td>{{$pack->prix}}</td>
                            <td>{{$pack->avence}}</td>
                            <td>{{$pack->reste}}</td>

                            <td>@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avance @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif</td>
                            <td>
                                <form action="{{route('pack.destroy',$pack->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#col{{$pack->id}}"><i class="fas fa-eye"></i></button>
                                    <a href="{{url('pack/'.$pack->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>

                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="col{{$pack->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$pack->nom.' '.$pack->prenom}} </h5> N° abennment :{{$pack->abonnement}}
                                    <button type="button" class="close btn text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    Information de Client : <hr>
                                    <div class="form-group col-6">
                                        <label class="col-form-label">Tele</label>
                                        <input type="text" class="form-control" value="{{$pack->tel}}" disabled>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="col-form-label">paye-ville</label>
                                        <input type="text" class="form-control" value="{{$pack->paye.'-'.$pack->ville}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Adress mac/APP</label>
                                        <input type="text" class="form-control" value="{{$pack->adress_mac}}" disabled>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                Information de IPTV : <hr>
                                    <div class="form-group col-3">
                                        <label class="col-form-label">Date creation</label>
                                        <input type="date" class="form-control" value="{{$pack->date_creation}}" disabled>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="message-text" class="col-form-label" >Date experation:</label>
                                        <input type="date" class="form-control"  value="{{$pack->date_experation}}" disabled>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="message-text" class="col-form-label" >Jours restants</label>
                                        <input type="text" class="form-control"  value="@if($pack->date_experation < Carbon::now()) @if(Carbon::parse($pack->date_experation)->diffInDays(Carbon::now()) != 0) - @endif     @endif{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::now())}}" disabled>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="message-text" class="col-form-label" >Status</label>
                                        <input type="text" class="form-control"  value="{{$pack->status}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="col-form-label">Fournisseur</label>
                                        <input type="text" class="form-control" value="{{$pack->forniceur}}" disabled>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="message-text" class="col-form-label" >Serveur</label>
                                        <input type="text" class="form-control"  value="{{$pack->serveur}}" disabled>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="message-text" class="col-form-label" >Panel</label>
                                        <input type="text" class="form-control"  value="{{$pack->panel}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="col-form-label">Prix</label>
                                        <input type="text" class="form-control" value="{{$pack->prix}}" disabled>
                                    </div>
                                    <div class="form-group col">
                                        <label for="message-text" class="col-form-label" >Avance</label>
                                        <input type="text" class="form-control"  value="{{$pack->avence}}" disabled>
                                    </div>
                                    <div class="form-group col">
                                        <label for="message-text" class="col-form-label" >Reste</label>
                                        <input type="text" class="form-control"  value="{{$pack->reste}}" disabled>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="message-text" class="col-form-label" >Moyen paiment</label>
                                        <input type="text" class="form-control"  value="{{$pack->moyen_paiment}}" disabled>
                                    </div>
                                    <div class="form-group col">
                                        <label for="message-text" class="col-form-label" >Status paiment</label>
                                        <input type="text" class="form-control"  value="@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avance @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif" disabled>
                                    </div>
                                    <div class="form-group col-4">
                                        <label class="col-form-label">M3U</label>
                                        <input type="text" class="form-control" value="{{$pack->m3u}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="message-text" class="col-form-label" >Remarque</label>
                                        <textarea class="form-control"  name="remarque" rows="3" disabled>{{$pack->remarque}}</textarea>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                <a href="{{url('pack/'.$pack->id.'/edit')}}" class="btn  btn-success"><i class="fas fa-edit"></i></a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                                </div>
                            </div>
                        </div>
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
        "language": {"sEmptyTable":     "Aucune donnée disponible dans le tableau",
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








