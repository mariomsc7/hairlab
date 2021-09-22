@extends('layouts.app')

@section('content')
    <div class="container">
            <a class="btn btn-primary text-uppercase" href="{{route('admin.clients.index')}}">Ritorna in clienti</a>

        <form class="delete-form d-inline-block" action="{{route('admin.clients.destroy', $client->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Elimina">
        </form>
        <h1 class="mb-5 mt-5">Storico appuntamenti cliente:</h1>
        <h3>{{$client->name}} {{$client->last_name}}</h3>
        {{$appointments->links()}}
        <table class="table mt-3">
            <thead>
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
                        <td>{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y'))}}</td>
                        <td>{{$appointment->employee->last_name}} {{$appointment->employee->name}}</td>
                        <td>€{{number_format($appointment->tot_paid, 2)}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.appointments.show', $appointment->id)}}">Dettagli</a>
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