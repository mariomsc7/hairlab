@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Appuntamento di
            <strong>{{ session('deleted') }} </strong>
            rimosso.
        </div>
        @endif
        <h2>Crea un nuovo appuntamento</h2>
        <a class="bn1 text-uppercase" href="{{route('admin.clients.index')}}">Crea appuntamento <i class="ml-2 fas fa-edit"></i></a>
        <h2 class="mt-3">Registra il cliente per un nuovo appuntamento</h2>
        <a class="bn1 text-uppercase" href="{{route('admin.clients.create')}}">Registra cliente <i class="ml-2 fas fa-user-plus"></i></a>
        <div class="row">
            <div class="mt-3 mb-3 col-md-6">
                <form action="{{route('admin.appointments.index')}}">
                    <h3>Filtra per mese</h3>
                    <input type="month" name="month" id="month" value="{{$query}}">
                    <div class="mt-2">
                        <button id="sub" type="submit" class="btn btn-dark">Cerca <i class="ml-1 fas fa-search"></i></button>
                        <button id="clear" type="button" class="btn btn-warning">Azzera Ricerca</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex mt-5 mb-5 justify-content-center">
            <div class="card">
                <h1>Appuntamenti <i class="ml-3 fas fa-address-book"></i></h1>
            </div>
        </div>
        {{$appointments->links()}}
        <div class="table-responsive">
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Orario</th>
                        <th>Cliente</th>
                        <th>Dipendente</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y'))}}</td>
                            @if ($appointment->client)
                                <td>{{$appointment->client->last_name}} {{$appointment->client->name}}</td>
                            @else
                                <td class="text-danger"><em>Nessun Dato</em></td>
                            @endif
                            
                            @if ($appointment->employee)
                                <td>{{$appointment->employee->last_name}} {{$appointment->employee->name}}</td>
                            @else
                                <td class="text-danger"><em>Nessun Dato</em></td>
                            @endif
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli <i class="ml-1 fas fa-info-circle"></i></a>
                                <a class="btn btn-warning" href="{{route('admin.appointments.edit', $appointment->id)}}">Modifica <i class="ml-1 fas fa-edit"></i></a>
                                <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection