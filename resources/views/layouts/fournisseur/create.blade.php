@extends('layouts.home')
@section('header')
<style>
</style>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Ajouter un fournisseur
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
                        <form  action="{{url('fournisseur')}}" method="post">
                            {{csrf_field()}}
                            <div class="card-body">

                                <div class="form-group">
                                    <label >Nom de fournisseur </label>
                                    <input type="text"  name="nom" class="form-control" placeholder="nom" value="{{old('nom')}}" >
                                    <span class="text-danger">{{$errors->first('nom')}}</span>
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

                                <div class="form-group mt-2">
                                    <label >choisissez les panel :</label>
                                    <table>
                                        @foreach($listpanel as $panel)
                                            <tr>
                                                <div class="form-group d-flex align-items-center">
                                                    <input type="checkbox" id="scales" name="panel[]" style="zoom: 1.5;" value="{{$panel->id}}">
                                                    <label class="fw-bold " >{{$panel->nom}}</label>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </table>
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

@section('scripts')

@endsection
