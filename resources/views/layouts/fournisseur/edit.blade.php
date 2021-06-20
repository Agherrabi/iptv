@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit le fournisseur
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
                        <form  action="{{url('fournisseur/'.$fournisseur->id)}}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label >Nom de fournisseur </label>
                                    <input type="text"  name="nom" class="form-control" value="{{$fournisseur->nom}}" >
                                    <span class="text-danger">{{$errors->first('nom')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Paye</label>
                                    <input type="text"  name="paye" class="form-control" value="{{$fournisseur->paye}}" >
                                    <span class="text-danger">{{$errors->first('paye')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Ville</label>
                                    <input type="text"  name="ville" class="form-control" value="{{$fournisseur->ville}}" >
                                    <span class="text-danger">{{$errors->first('ville')}}</span>
                                </div>
                                <div class="form-group">
                                    <label >Tel</label>
                                    <input type="text"  name="tel" class="form-control" value="{{$fournisseur->tel}}" >
                                    <span class="text-danger">{{$errors->first('tel')}}</span>
                                </div>
                                <div class="form-group mt-2">
                                    <label >choisissez les panel :</label>
                                    <table>
                                        @foreach($listpanel as $panel)
                                            <tr>
                                                <div>
                                                    <input type="checkbox" id="scales" name="panel[]" style="zoom: 1.5;"  value="{{$panel->id}}"
                                                    @if (count($four_panels->where('panel_id', $panel->id)))
                                                        checked
                                                    @endif>
                                                    <label class="fw-bold ">{{$panel->nom}}</label>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </table>
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
