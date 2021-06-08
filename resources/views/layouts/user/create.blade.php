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
                        <form  action="{{url('userstore')}}" method="post">
                            {{csrf_field()}}
                            <div class="card-body">

                            <div class="form-group">
                                <label >Nom</label>
                                <input type="text"  name="nom" class="form-control" placeholder="nom" value="{{old('nom')}}" >
                                <span class="text-danger">{{$errors->first('nom')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Email</label>
                                <input type="text"  name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                                <span class="text-danger">{{$errors->first('email')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password"  name="password" class="form-control" placeholder="Password" >
                                <span class="text-danger">{{$errors->first('password')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password"  name="password_confirmation" class="form-control" placeholder="Password"  >
                                <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                            </div>
                            <div class="form-group">
                                <label >Role</label>
                               <select name="is_admin"  class="form-control">
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                               </select>
                                <span class="text-danger">{{$errors->first('is_admin')}}</span>
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
