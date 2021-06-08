@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header d-flex">
            <div class="p-2"><i class="fas fa-table me-1 "></i>
            List des user</div>
            <div class="mr-auto p-2"><a class="btn btn-sm btn-info" href="">Ajouter</a></div>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style='max-width:60px'>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($listuser as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>@if($user->is_admin == 1) Admin @else user @endif</td>
                        <td>
                            <form action="#" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <a href="{{url('user/'.$user->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection