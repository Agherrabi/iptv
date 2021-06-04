@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des pack
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Pack</th>
                        <th>Prix</th>
                        <th>duree</th>
                        <th style='width:60px'>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($listpack as $pack)
                    <tr>
                        <td>{{$pack->label}}</td>
                        <td>{{$pack->prix}}</td>
                        <td>{{$pack->duree}}</td>
                        <td>
                            <form action="{{route('pack.destroy',$pack->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <a href="{{url('pack/'.$pack->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
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
