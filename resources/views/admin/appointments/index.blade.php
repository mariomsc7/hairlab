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
        <a class="btn btn-primary text-uppercase" href="{{route('admin.home')}}">Ritorna alla home</a>
        
        <h1 class="mb-5 mt-5">Appuntamenti:</h1>
        @foreach($appointments as $appointment)
            <hr>
            <h3>Nome cliente: {{$appointment->client->name}} {{$appointment->client->last_name}}</h3>
            <h3>Data: {{$appointment->start_time}}</h3>
            <h3>Dipendente: {{$appointment->employee->name}}</h3>
            @foreach($appointment->services as $service)
                @if ($loop->last)
                    <span>{{$service->name}}</span>
                @else
                    <span>{{$service->name}}, </span>
                @endif
            @endforeach
            <div>{{$appointment->tot_paid}}</div>
            <hr>
        @endforeach
    </div>

@endsection