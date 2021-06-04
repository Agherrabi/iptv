@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit le pack
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
                                <label >Pack </label>
                                <input type="text"  name="label" class="form-control" value="{{$pack->label}}" >
                                <span class="text-danger">{{$errors->first('label')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Prix</label>
                                <input type="text"  name="prix" class="form-control" value="{{$pack->prix}}" >
                                <span class="text-danger">{{$errors->first('prix')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Duree</label>
                                <input type="text"  name="duree" class="form-control" value="{{$pack->duree}}">
                                <span class="text-danger">{{$errors->first('duree')}}</span>
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
