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
                        <th>Client</th>
                        <th>Abennement</th>
                        <th>pays-ville</th>
                        <th>status</th>
                        <th>Prix</th>
                        <th>Avence</th>
                        <th>Reste</th>
                        <th>Status</th>
                        <th style='width:60px'>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($listpack as $pack)
                    <tr>
                        <td>{{$pack->nom.' '.$pack->prenom}}</td>
                        <td>{{$pack->abonnement}}</td>
                        <td>{{$pack->paye.'-'.$pack->ville}}</td>
                        <td>{{$pack->status}}</td>
                        <td>{{$pack->prix}}</td>
                        <td>{{$pack->avence}}</td>
                        <td>{{$pack->reste}}</td>
                        <td>{{$pack->status_paiment}}</td>
                        <td>
                            <form action="{{route('pack.destroy',$pack->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#col{{$pack->id}}"><i class="fas fa-eye"></i></button>
                                <a href="{{url('pack/'.$pack->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                            </form>

                        </td>
                    </tr>

                    <!-- Modal -->
                    <div class="modal fade" id="col{{$pack->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{$pack->nom.' '.$pack->prenom}} </h5> N° abennment :{{$pack->abonnement}}
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <small>paye :{{$pack->paye}}</small> <small>ville :{{$pack->ville}}</small>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label class="col-form-label">Date creation</label>
                                    <input type="text" class="form-control" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="message-text" class="col-form-label">Date experation:</label>
                                    <input type="text" class="form-control" >
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
            <!-- Button trigger modal -->

        </div>
    </div>
@endsection
