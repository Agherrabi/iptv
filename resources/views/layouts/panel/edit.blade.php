@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit le panel
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
                        <form  action="{{url('panel/'.$panel->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label >Nom de panel </label>
                                    <input type="text"  name="nom" class="form-control" value="{{$panel->nom}}" >
                                    <span class="text-danger">{{$errors->first('nom')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >serveur</label>
                                    <input type="text"  name="serveur" class="form-control" value="{{$panel->serveur}}" >
                                    <span class="text-danger">{{$errors->first('serveur')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >username</label>
                                    <input type="text"  name="username" class="form-control" value="{{$panel->username}}" >
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >quantité</label>
                                    <input type="text"  name="qtte" class="form-control" value="{{$panel->qtte}}" >
                                    <span class="text-danger">{{$errors->first('qtte')}}</span>
                                </div>
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
