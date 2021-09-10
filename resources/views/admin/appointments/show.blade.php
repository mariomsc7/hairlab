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
        <a class="btn btn-primary text-uppercase" href="{{route('admin.appointments.index')}}">Ritorna in appuntamenti</a>
        <a class="btn btn-warning text-uppercase" href="{{route('admin.appointments.edit', $appointment->id)}}">Modifica appuntamento</a>
        <h1 class="mb-5 mt-5">Dettagli appuntamento:</h1>
        <div class="row">
                <div class="col-md-4">
                    <h3>Nome cliente:</h3>
                    <p>{{$appointment->client->name}} {{$appointment->client->last_name}}</p>
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
                    <h3>Prezzo:</h3>
                    <p>€{{number_format($appointment->tot_paid, 2)}}</p>
                </div>
                {{-- COMMENTI A LATO --}}
                <div class="col-md-6 offset-md-2">
                    <h3>Commento:</h3>
                    <p>{{$appointment->comment}}</p>
                </div>
        </div>
    </div>

@endsection