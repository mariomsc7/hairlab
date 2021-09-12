@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('deleted'))
        <div class="alert alert-success">
            Appuntamento
            <strong>{{ session('deleted') }} </strong>
            rimosso.
        </div>
        @endif
        @if ($appointment->done === 0)
            <a class="btn btn-primary text-uppercase" href="{{route('admin.appointments.index')}}">Ritorna in appuntamenti</a>
            <a class="btn btn-warning text-uppercase" href="{{route('admin.appointments.edit', $appointment->id)}}">Modifica appuntamento</a>
        @else
            <a class="btn btn-primary text-uppercase" href="{{route('admin.appointments.done.index')}}">Ritorna a storico</a>
        @endif
        <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Elimina">
        </form>
        <h1 class="mb-5 mt-5">Dettagli appuntamento:</h1>
        <div class="row">
            <div class="col-md-4">
                <h3>Nome cliente:</h3>
                <p>{{$appointment->client->last_name}} {{$appointment->client->name}}</p>
                <h3>Data:</h3>
                <p>{{$appointment->start_time}}</p>
                <h3>Dipendente:</h3>
                <p>{{$appointment->employee->name}}</p>
                <h3>Servizi:</h3>
                <p>
                    @foreach($appointment->services as $service)
                        @if ($loop->last)
                            <span>{{$service->name}}</span>
                        @else
                            <span>{{$service->name}}, </span>
                        @endif
                    @endforeach
                </p>
                <h3>Extra:</h3>
                <p>€{{number_format($appointment->extra, 2)}}</p>
                <h3>Prezzo totale:</h3>
                <p>€{{number_format($appointment->tot_paid, 2)}}</p>
            </div>
            {{-- COMMENTI A LATO --}}
            <div class="col-md-6 offset-md-2 d-flex flex-column justify-content-between">
                <div>
                    <h3>Commento:</h3>
                    <p>{{$appointment->comment}}</p>
                </div>
                @if ($appointment->done === 0)
                    <form id="pay" action="{{route('admin.appointments.done.update', $appointment->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="submit" class="btn btn-success text-uppercase" value="Pagato">
                    </form>
                @endif
            </div>
        </div>
    </div>

@endsection