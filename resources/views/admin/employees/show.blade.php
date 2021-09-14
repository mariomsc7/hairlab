@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Dipendente
            <strong>{{ session('deleted') }} </strong>
            rimosso.
        </div>
        @endif
            <a class="btn btn-primary text-uppercase" href="{{route('admin.employees.index')}}">Ritorna in dipendenti</a>

        <form class="delete-form d-inline-block" action="{{route('admin.employees.destroy', $employee->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Elimina">
        </form>
        <h1 class="mb-5 mt-5">Dettagli produzione:</h1>
            <div class="">
                <h3>Nome dipendente:</h3>
                <p>{{$employee->last_name}} {{$employee->name}}</p>
                <h3>Appuntamenti Effettuati:</h3>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th>Orario</th>
                            <th>Cliente</th>
                            <th>Pagato</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                        @if ($appointment->done)
                            <tr>
                                <td>{{$appointment->start_time}}</td>
                                <td>{{$appointment->client->last_name}} {{$appointment->client->name}}</td>
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
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

@endsection