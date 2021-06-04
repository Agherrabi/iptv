@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Ajouter un pack
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
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
                                </div>
                                <div class="form-group">
                                    <label > </label>
                                    <input type="text"  name="" value="{{old('')}}" class="form-control" >
                                    <span class="text-danger">{{$errors->first('')}}</span>
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
