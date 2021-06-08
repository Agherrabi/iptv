
@extends('layouts.home')
@section('content')
<?php
use Carbon\Carbon;
?>
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

    </style>
    <div class="card mb-4">


    <section class="search-sec">
        <div class="container">
            <form action="recherch" method="post" >
            {{csrf_field()}}
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <input type="text" name="nom" class="form-control search-slt" placeholder="Client">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <input type="text" name="abonnement" class="form-control search-slt" value="{{old('abonnement')}}"placeholder="N d'Abonnement">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <select class="form-control search-slt" name="status" >
                                    <option value="">Etat </option>
                                    <option value="active">Active</option>
                                    <option value="expiré">Expiré</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                <select class="form-control search-slt" name="statusP" >
                                    <option value="">Statut de paiement </option>
                                    <option value="n">Non Payé</option>
                                    <option value="a">Avence</option>
                                    <option value="p">Payé</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                <button type="submit" class="btn btn-danger wrn-btn">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>





    <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des abonnements
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-sm" class="display" id="datatablesSimple" >
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Abonnement</th>
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

                            <td>@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif</td>
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
                                        <input type="text" class="form-control"  value="@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif" disabled>
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
{{--
    <div class="card mb-4 mt-5">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des Abonnements payé
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-hover border" class="display" id="datatablesSimple3" >
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Abonnement</th>
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
                    @foreach($listpacknonpaye as $pack)
                        <tr>
                            <td>{{$pack->nom.' '.$pack->prenom}}</td>
                            <td>{{$pack->abonnement}}</td>
                            <td>{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}</td>
                            <td>{{$pack->status}}</td>
                            <td>{{$pack->prix}}</td>
                            <td>{{$pack->avence}}</td>
                            <td>{{$pack->reste}}</td>

                            <td>@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif</td>
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
                                        <input type="text" class="form-control"  value="@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif" disabled>
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
    <div class="card mb-4 mt-5">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Liste des Abonnements avec 15 jours restant
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-hover border" class="display" id="datatablesSimple1" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Client</th>
                            <th>Abonnement</th>
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
                    @foreach($listpack15jours as $pack)
                        <tr>
                            <td>{{$pack->nom.' '.$pack->prenom}}</td>
                            <td>{{$pack->abonnement}}</td>
                            <td>{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}</td>
                            <td>{{$pack->status}}</td>
                            <td>{{$pack->prix}}</td>
                            <td>{{$pack->avence}}</td>
                            <td>{{$pack->reste}}</td>

                            <td>@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif</td>
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
                                        <input type="text" class="form-control"  value="@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif" disabled>
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
    <div class="card mb-4 mt-5">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des Abonnements Expiré
        </div>
        <div class="card-body ">
            <div class="table-responsive-sm">
                <table class="table table-hover border" class="display" id="datatablesSimple2" >
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Abonnement</th>
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
                    @foreach($listpackexpire as $pack)
                        <tr>
                            <td>{{$pack->nom.' '.$pack->prenom}}</td>
                            <td>{{$pack->abonnement}}</td>
                            <td>{{Carbon::parse($pack->date_experation)->diffInDays(Carbon::parse($pack->date_creation))}}</td>
                            <td>{{$pack->status}}</td>
                            <td>{{$pack->prix}}</td>
                            <td>{{$pack->avence}}</td>
                            <td>{{$pack->reste}}</td>

                            <td>@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif</td>
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
                                        <input type="text" class="form-control"  value="@if($pack->status_paiment == 'n') Non payé @elseif($pack->status_paiment == 'a') Avence @elseif($pack->status_paiment == 'p') Payé @else Autre  @endif" disabled>
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




--}}



@endsection


@section('script')
<script>
    //     $(document).ready( function () {

    //         $('#maree_id').change(function(){

    //             var maree_id = document.getElementById('maree_id').value;
    //             if(maree_id > 0){
    //                 fetchRecords(maree_id);
    //             }
    //             });

    //             function fetchRecords(id){

    //             $.ajax({

    //             url: "{{URL::to('packdata')}}",
    //             type: "POST",
    //             data: {
    //             "_token": "{{ csrf_token() }}",
    //             "id": id
    //             },
    //             dataType: 'json',
    //             success: function(response){
    //                 console.log(response);
    //                 var len = 0;
    //                 $('#facteurTable tbody').empty(); // Empty <tbody>
    //                 if(response['data'] != null){

    //                     len = response['data'].length;
    //                 }

    //                 if(len > 0){
    //                     for(var i=0; i<len; i++){
    //                     var dech_id = response['data'][i].dech_id;
    //                     var espece_id = response['data'][i].espece_id;
    //                     var maree = response['data'][i].maria_nom;
    //                     var ref = response['data'][i].ref;
    //                     var description = response['data'][i].description;
    //                     var nom_espece = response['data'][i].nom_espece;
    //                     var maree_id = response['data'][i].maree_id;
    //                     var qtterestant = response['data'][i].qtterestant;
    //                     var qtte_dech = response['data'][i].qtte_dech;
    //                     var date_saisir = response['data'][i].date_saisir;
    //                     var pm = response['data'][i].pm;
    //                     var pru= response['data'][i].pru;
    //                     var devis = response['data'][i].devis;
    //                     var tara = response['data'][i].tara;

    //                     var tr_str = "<tr>" +
    //                         "<td align='center' name='id[]'>" + maree + "</td>" +
    //                         "<td align='center' name='ref[]'>" + ref + "</td>" +
    //                         "<td align='center' name='espece_id[]'>" + description + "</td>" +
    //                         "<td align='center' ><label >" + qtterestant + "</label></td>" +
    //                         "<td align='center'><input class='t12 form-control' type='text' name='qtte_commande[]' ><small class='error' id='error'>{{$errors->first('espece_id')}}{{$errors->first('qtte_commande')}}</small><input type='hidden'class='t11' name='qtterestant[]' value=" + qtterestant + "> <input type='hidden' name='espece_id[]' value=" + espece_id + "><input type='hidden' name='description[]' value=" + description + "><input type='hidden' name='dech_id[]' value=" + dech_id + "><input type='hidden' name='pm[]' value=" + pm + "><input type='hidden' name='pru[]' value=" + pru + "><input type='hidden' name='devis[]' value=" + devis + "><input type='hidden' name='tara[]' value=" + tara + "></td>"+
    //                         "<td align='center'><a href='javascript:void(0);'  class='remove'><i class='fas fa-trash'></a></td>" +
    //                     "</tr>";

    //                     $("#facteurTable tbody").append(tr_str);
    //                     }
    //                 }else{
    //                     var tr_str = "<tr>" +
    //                         "<td align='center' colspan='4'>No record found.</td>" +
    //                     "</tr>";

    //                     $("#facteurTable tbody").append(tr_str);
    //                 }


    //                 var qttec = document.querySelectorAll('.t12');
    //                 var er = document.querySelectorAll('.error');

    //                 $(".t12").keyup(function(){
    //                     var inp1 = parseInt($(this).siblings(".t11").val(), 10);
    //                     if($(this).val() > inp1){
    //             $(this).css("border", "1px solid red");
    //                     }

    //                     else{
    //             $(this).css("border", "1px solid #ced4da");
    //                     }

    //                     });

    //                 }
    //             });
    //         }


    // } );


</script>
@endsection








