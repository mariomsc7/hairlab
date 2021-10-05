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
        <h1 class="mb-5 mt-5 font-weight-bold"><i class="fas fa-info-circle"></i> Dettagli appuntamento</h1>
        @if ($appointment->done === 0)
            <a class="bn1 mr-1 text-uppercase" href="{{ route('admin.appointments.index') }}">Appuntamenti <i class="fas fa-address-book"></i></a>
            <a class="bn1 text-uppercase" href="{{route('admin.appointments.edit', $appointment->id)}}">Modifica appuntamento <i class="ml-1 fas fa-edit"></i></a>
        @else
            <a class="bn1 text-uppercase" href="{{route('admin.appointments.done.index')}}">Ritorna a storico</a>
        @endif

        @if ($appointment->client)
            <a class="bn1 text-uppercase" href="{{route('admin.clients.show', $appointment->client->id)}}">Dettaglio cliente <i class="fas fa-user"></i></a>
        @endif

        @if (Auth::id() === 1 && $appointment->employee)
            <a class="bn1 text-uppercase" href="{{route('admin.employees.show', $appointment->employee->id)}}">Produzione dipendente</a>
        @endif
        @if (Auth::id() === 1 || $appointment->done === 0)
        <form class="delete-form d-inline-block" action="{{route('admin.appointments.destroy', $appointment->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bn1">Elimina <i class="ml-1 fas fa-trash-alt"></i></button>
        </form>
        @endif
        <div class="row mt-5">
            <div class="col-md-4">
                <h3>Nome cliente:</h3>
                @if ($appointment->client)
                    <p>{{$appointment->client->last_name}} {{$appointment->client->name}}</p>
                @else
                    <p class="text-danger"><em>Nessun Dato</em></p>
                @endif
                <h3>Data:</h3>
                <p>{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y - %R'))}} -> {{ucfirst($appointment->end_time->formatLocalized('%R'))}}</p>
                <h3>Dipendente:</h3>
                @if ($appointment->employee)
                    <p>{{$appointment->employee->name}}</p>
                @else
                    <p class="text-danger"><em>Nessun Dato</em></p>
                @endif                
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