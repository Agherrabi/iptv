@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Ajouter un client
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
                        <form  action="{{url('client')}}" method="post">
                            {{csrf_field()}}
                            <div class="card-body">

                            <div class="form-group">
                                <label >Nom de client </label>
                                <input type="text"  name="nom" class="form-control" placeholder="nom" value="{{old('nom')}}" >
                                <span class="text-danger">{{$errors->first('nom')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Prenom</label>
                                <input type="text"  name="prenom" class="form-control" placeholder="Prenom" value="{{old('prenom')}}">
                                <span class="text-danger">{{$errors->first('prenom')}}</span>
                            </div>
                            <div class="form-group">
                                <label >N Abonnement </label>
                                <input type="text"  name="abonnement" class="form-control" placeholder="Abonnement" value="{{old('Abonnement')}}" >
                                <span class="text-danger">{{$errors->first('abonnement')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Paye</label>
                                <input type="text"  name="paye" class="form-control" placeholder="Paye" value="{{old('paye')}}" >
                                <span class="text-danger">{{$errors->first('paye')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Ville</label>
                                <input type="text"  name="ville" class="form-control" placeholder="Ville" value="{{old('ville')}}">
                                <span class="text-danger">{{$errors->first('ville')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Tel</label>
                                <input type="text"  name="tel" class="form-control" placeholder="Tel" value="{{old('tel')}}" >
                                <span class="text-danger">{{$errors->first('tel')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Adress mac/App</label>
                                <input type="text"  name="adress_mac" class="form-control" placeholder="Adress mac" value="{{old('adress_mac')}}" >
                                <span class="text-danger">{{$errors->first('adress_mac')}}</span>
                            </div>
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

@section('script')

@endsection
