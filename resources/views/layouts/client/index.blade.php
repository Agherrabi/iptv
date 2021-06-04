@extends('layouts.home')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            List des Client
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Abennement</th>
                        <th>Paye</th>
                        <th>Ville</th>
                        <th>Tel</th>
                        <th>Adpress Mac/App</th>
                        <th style='width:60px'>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($listclient as $client)
                    <tr>
                        <td>{{$client->nom.' '.$client->prenom}}</td>
                        <td>{{$client->abonnement}}</td>
                        <td>{{$client->paye}}</td>
                        <td>{{$client->ville}}</td>
                        <td>{{$client->tel}}</td>
                        <td>{{$client->adress_mac}}</td>
                        <td>
                            <form action="{{route('client.destroy',$client->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <a href="{{url('client/'.$client->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
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
