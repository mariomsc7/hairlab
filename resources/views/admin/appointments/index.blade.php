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
        <h2 class="mt-5">Registra il cliente per un nuovo appuntamento</h2>
        <a class="btn btn-success text-uppercase" href="{{route('admin.clients.create')}}">Registra cliente</a>
        <h1 class="mb-5 mt-5">Appuntamenti:</h1>
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
                        <td>{{$appointment->client->last_name}} {{$appointment->client->name}}</td>
                        <td>{{$appointment->employee->last_name}} {{$appointment->employee->name}}</td>
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