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
        <a class="btn btn-success text-uppercase" href="{{route('admin.clients.index')}}">Crea appuntamento</a>
        <h2 class="mt-3">Registra il cliente per un nuovo appuntamento</h2>
        <a class="btn btn-success text-uppercase" href="{{route('admin.clients.create')}}">Registra cliente</a>
        <div class="row">
            <h1 class="mb-5 mt-5 col-md-6">Appuntamenti:</h1>
            <div class="col-md-6">
                <form action="{{route('admin.appointments.index')}}">
                    <h3>Cerca per mese</h3>
                    <input type="month" name="month" id="month" value="{{$query}}">
                    <div class="mt-2">
                        <button id="sub" type="submit" class="btn btn-dark">Filtra Mese</button>
                        <button id="clear" type="button" class="btn btn-warning">Azzera Ricerca</button>
                    </div>
                </form>
            </div>
        </div>
        {{$appointments->links()}}
        <table class="table mt-3">
            <thead>
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
                            <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli</a>
                            <a class="btn btn-warning" href="{{route('admin.appointments.edit', $appointment->id)}}">Modifica</a>
                            <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger" value="Elimina">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection