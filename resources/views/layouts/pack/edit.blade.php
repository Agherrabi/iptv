@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit l'abonnement
        </div>
        <div class="card-body">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary">
                            @if(session()->has('success'))
                                <div class="alert alert-success">{{session()->get('success')}}</div>
                            @endif

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form  action="{{url('pack/'.$pack->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            {{csrf_field()}}
                            <div class="card-body">
                            <div class="form-group">
                                    <label class="h6">Client <small class="h5 text-danger">(*)</small></label>
                                    <select name="client" id="" class="form-control">
                                        <option value="">-- choisir un client --</option>
                                        @foreach($listclient as $client)
                                        <option value="{{$client->id}}" {{$client->id == $pack->client_id ? 'selected' : ''}}>{{$client->nom.' '.$client->prenom}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('client')}}</span>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="h6">Date de creation <small class="h5 text-danger">(*)</small></label>
                                        <input type="date"  name="date_creation" value="{{$pack->date_creation}}" class="form-control" >
                                        <span class="text-danger">{{$errors->first('date_creation')}}</span>
                                    </div>
                                    <div class="form-group col">
                                        <label class="h6">Date d'experation <small class="h5 text-danger">(*)</small></label>
                                        <input type="date"  name="date_experation" value="{{$pack->date_experation}}" class="form-control" >
                                        <span class="text-danger">{{$errors->first('date_experation')}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="h6">Status </label>
                                    <select name="status" class="form-control"  >
                                        <option value="">-- Choisir --</option>
                                        <option value="active" {{($pack->status ==='active') ? 'selected' : ''}}>Active</option>
                                        <option value="expire"{{($pack->status ==='expire') ? 'selected' : ''}}>Expiré</option>
                                    </select>
                                    <span class="text-danger">{{$errors->first('status')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Fournisseur</label>
                                    <select name="four_id" id="four_id"  class="form-control">
                                        <option value="">-- choisir un Fournisseur --</option>
                                        @foreach($listfournisseur as $fournisseur)
                                        <option value="{{$fournisseur->id}}" {{($fournisseur->id ===$pack->four_id) ? 'selected' : ''}}>{{$fournisseur->nom}}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger">{{$errors->first('fournisseur')}}</span>
                                </div>
                            {{--
                                <div class="form-group">
                                        <label class="h6">Serveur</label>
                                        <input type="text"  name="serveur" value="{{$pack->serveur}}" class="form-control" >
                                        <span class="text-danger">{{$errors->first('serveur')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="h6">Username</label>
                                        <input type="text"  name="username" value="{{$pack->username}}" class="form-control" >
                                        <span class="text-danger">{{$errors->first('username')}}</span>
                                    </div>
                            --}}
                                <div class="form-group">
                                    <label >Panel</label>
                                    <select name="panel_id" id="panel_dropdown" class="form-control" value="{{$pack->serveur}}">
                                            <option value="">{{$pack->panel}}</option>
                                    </select>

                                    <span class="text-danger">{{$errors->first('panel')}}</span>
                                </div>

                                <div class="form-group">
                                    <label class="h6">Prix<small class="h5 text-danger">(*)</small></label>
                                    <input type="text"  name="prix" value="{{$pack->prix}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('prix')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="h6">Avance</label>
                                    <input type="text"  name="avence" value="{{$pack->avence}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('avence')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="h6">Moyen paiment</label>
                                    <input type="text"  name="moyen_paiment" value="{{$pack->moyen_paiment}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('moyen_paiment')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="h6">Status paiment</label>
                                    <select  name="status_paiment" class="form-control" >
                                        <option value="">-- Choisir --</option>
                                        <option value="n" {{($pack->status_paiment ==='n') ? 'selected' : ''}} >Non payé</option>
                                        <option value="a" {{($pack->status_paiment ==='a') ? 'selected' : ''}} >Avance</option>
                                        <option value="p" {{($pack->status_paiment ==='p') ? 'selected' : ''}} >payé</option>
                                    </select>
                                    <span class="text-danger">{{$errors->first('status_paiment')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="h6">M3u</label>
                                    <input type="text"  name="m3u" value="{{$pack->m3u}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('m3u')}}</span>
                                </div>
                                <div class="form-group">
                                    <label class="h6">Remarque</label>
                                    <textarea class="form-control"  name="remarque" value="{{$pack->remarque}}" rows="3"></textarea>
                                    <span class="text-danger">{{$errors->first('remarque')}}</span>
                                </div>
                                <small class="h5 text-danger">(*)</small>: champs obligatoires
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('script')
<script>
     $(document).ready( function () {

$('#four_id').change(function(){
    var maree_id = document.getElementById('four_id').value;
    if(maree_id > 0){
        fetchRecords(maree_id);
    }
    });

    function fetchRecords(id){

    $.ajax({

    url: "{{URL::to('getpanel')}}",
    type: "POST",
    data: {
    "_token": "{{ csrf_token() }}",
    "id": id
    },
    dataType: 'json',
    success: function(response){
        console.log(response);
        var len = 0;
        $('#panel_dropdown').empty() ; // Empty <tbody>
        if(response['data'] != null){

            len = response['data'].length;
        }

        if(len > 0){
            var option1 = "<option value='' >-- Choisir un Panel --</option>";$("#panel_dropdown").append(option1);
            for(var i=0; i<len; i++){
            var id = response['data'][i].id;
            var nom = response['data'][i].nom;

            var option = "<option value='"+id+"' >"+nom+"</option>";


            $("#panel_dropdown").append(option);
            }
        }else{
            $('#panel_dropdown').empty() ;
            var option = "<option value='' >-- vide --</option>";
        }

        }
    });
}






});

</script>
@endsection
