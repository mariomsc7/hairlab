@extends('layouts.app')

@section('content')
    <div class="container">
            <a class="bn1 text-uppercase" href="{{route('admin.clients.index')}}">Clienti <i class="fas fa-users"></i></a>
            <a class="bn1 text-uppercase" href="{{route('admin.appointments.create', $client->id)}}">Crea Appuntamento <i class="fas fa-address-book"></i></a>
        <form class="delete-form d-inline-block" action="{{route('admin.clients.destroy', $client->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bn1">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
        </form>
        <h1 class="mb-5 mt-5">Appuntamenti cliente</h1>
        <h3 class="text-primary"><i class="fas fa-user"></i> {{$client->name}} {{$client->last_name}}</h3>
        {{$appointments->links()}}
        <div class="table-responsive">
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Data</th>
                        <th>Dipendente</th>
                        <th>Pagato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td class="pt-4">{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y'))}}</td>
                            <td class="pt-4">{{$appointment->employee->last_name}} {{$appointment->employee->name}}</td>
                            <td class="pt-4">€{{number_format($appointment->tot_paid, 2)}}</td>
                            <td>
                                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav{{$loop->index}}" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                      <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav{{$loop->index}}">
                                      <ul class="navbar-nav">
                                        <li class="nav-item active mt-2 mr-1 mb-2">
                                            <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli <i class="ml-1 fas fa-info-circle"></i></a>
                                        </li>
                                        <li class="nav-item mt-2 mr-1 mb-2">
                                            <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
                                            </form>
                                        </li>
                                      </ul>
                                    </div>
                                </nav>                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection