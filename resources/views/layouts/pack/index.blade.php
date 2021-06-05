
@extends('layouts.home')
@section('content')
<?php
use Carbon\Carbon;
?>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des abonnements
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-sm" id="datatablesSimple" >
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Abennement</th>
                            <th>reste</th>
                            <th>status</th>
                            <th>Prix</th>
                            <th>Avence</th>
                            <th>Reste</th>
                            <th>Status</th>
                            <th style="min-width:90px !important">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($listpack as $pack)
                        <tr>
                            <td>{{$pack->nom.' '.$pack->prenom}}</td>
                            <td>{{$pack->abonnement}}</td>
                            <td>{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}</td>
                            <td>{{$pack->status}}</td>
                            <td>{{$pack->prix}}</td>
                            <td>{{$pack->avence}}</td>
                            <td>{{$pack->reste}}</td>

                            <td>{{$pack->status_paiment}}</td>
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
                                        <input type="text" class="form-control"  value="{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}" disabled>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="message-text" class="col-form-label" >Status</label>
                                        <input type="text" class="form-control"  value="{{$pack->status}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="col-form-label">Forniceur</label>
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
                                        <label for="message-text" class="col-form-label" >Avence</label>
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
                                        <input type="text" class="form-control"  value="{{$pack->status_paiment}}" disabled>
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
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des Abonnements
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-hover border" id="datatablesSimple1" >
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Abennement</th>
                            <th>reste</th>
                            <th>status</th>
                            <th>Prix</th>
                            <th>Avence</th>
                            <th>Reste</th>
                            <th>Status</th>
                            <th style="min-width:90px !important">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($listpack as $pack)
                        <tr>
                            <td>{{$pack->nom.' '.$pack->prenom}}</td>
                            <td>{{$pack->abonnement}}</td>
                            <td>{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}</td>
                            <td>{{$pack->status}}</td>
                            <td>{{$pack->prix}}</td>
                            <td>{{$pack->avence}}</td>
                            <td>{{$pack->reste}}</td>

                            <td>{{$pack->status_paiment}}</td>
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
                                        <input type="text" class="form-control"  value="{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}" disabled>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="message-text" class="col-form-label" >Status</label>
                                        <input type="text" class="form-control"  value="{{$pack->status}}" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label class="col-form-label">Forniceur</label>
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
                                        <label for="message-text" class="col-form-label" >Avence</label>
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
                                        <input type="text" class="form-control"  value="{{$pack->status_paiment}}" disabled>
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
    $(document).ready( function () {
        $('#datatablesSimple1').DataTable();

});
</script>
@endsection
