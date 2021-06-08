@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Ajouter un Abonnement
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                            @if(session()->has('success'))
                                <div class="alert alert-success">{{session()->get('success')}}</div>
                            @endif

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form  action="{{url('pack')}}" method="post">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label >Client <small class="h5 text-danger">*</small></label>
                                    <select name="client" id="" class="form-control">
                                        <option value="">-- choisir un client --</option>
                                        @foreach($listclient as $client)
                                        <option value="{{$client->id}}">{{$client->nom.' '.$client->prenom}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('client')}}</span>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label >Date de creation <small class="h5 text-danger">*</small></label>
                                        <input type="date"  name="date_creation" value="{{old('date_creation')}}" class="form-control" >
                                        <span class="text-danger">{{$errors->first('date_creation')}}</span>
                                    </div>
                                    <div class="form-group col">
                                        <label >Date d'experation <small class="h5 text-danger">*</small></label>
                                        <input type="date"  name="date_experation" value="{{old('date_experation')}}" class="form-control" >
                                        <span class="text-danger">{{$errors->first('date_experation')}}</span>
                                    </div>
                                </div>
                                {{--<div class="form-group">
                                    <label >Status </label>
                                    <select name="status" class="form-control" >
                                        <option value="">-- Choisir --</option>
                                        <option value="active">Active</option>
                                        <option value="expire">Expiré</option>
                                    </select>
                                    <span class="text-danger">{{$errors->first('status')}}</span>
                                </div>--}}
                                <div class="form-group">
                                    <label >Forniceur</label>
                                    <input type="text"  name="forniceur" value="{{old('forniceur')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('forniceur')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Serveur</label>
                                    <input type="text"  name="serveur" value="{{old('serveur')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('serveur')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Panel</label>
                                    <input type="text"  name="panel" value="{{old('panel')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('panel')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Username</label>
                                    <input type="text"  name="username" value="{{old('username')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Prix <small class="h5 text-danger">*</small></label>
                                    <input type="text"  name="prix" value="{{old('prix')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('prix')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Avance</label>
                                    <input type="text"  name="avence" value="{{old('avence')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('avence')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Moyen paiment</label>
                                    <input type="text"  name="moyen_paiment" value="{{old('moyen_paiment')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('moyen_paiment')}}</span>
                                </div>
                                {{-- <div class="form-group">
                                    <label >Status paiment</label>
                                    <select  name="status_paiment" class="form-control" style="" required>
                                        <option value="">-- Choisir --</option>
                                        <option value="n" >Non payé</option>
                                        <option value="a" >Avance</option>
                                        <option value="p" >payé</option>
                                    </select>
                                    <span class="text-danger">{{$errors->first('status_paiment')}}</span>
                                </div> --}}
                                <div class="form-group">
                                    <label >M3u</label>
                                    <input type="text"  name="m3u" value="{{old('m3u')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('m3u')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Remarque</label>
                                    <textarea class="form-control"  name="remarque" value="{{old('remarque')}}" rows="3">{{old('remarque')}}</textarea>
                                    <span class="text-danger">{{$errors->first('remarque')}}</span>
                                </div>
                                <small class="h5 text-danger">(*)</small>: champs obligatoires
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
