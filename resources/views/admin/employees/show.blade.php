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
            <input type="submit" class="btn btn-danger text-uppercase" value="Elimina">
        </form>
        <div class="row mb-5 mt-5">
            <h1 class="col-md-6">Dettagli produzione:</h1>
            <h2 class="mt-2 col-md-6">Totale: €{{number_format($total, 2)}}</h2>
        </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Nome dipendente:</h3>
                    <p>{{$employee->last_name}} {{$employee->name}}</p>
                </div>

                {{-- Production --}}
                <div class="col-md-6">
                    <h3>Totale mensile:</h3>
                    <form action="{{route('admin.employees.show', $employee->id)}}">
                        <input type="month" name="month" id="month" value="{{$query}}">
                        <div class="mt-2">
                            <button id="sub" type="submit" class="btn btn-dark">Filtra Mese</button>
                            <button id="clear" type="button" class="btn btn-warning">Azzera Ricerca</button>
                        </div>
                        @if ($query !== '')
                            <h4 class="mt-2">Tot: €{{number_format($tot_month, 2)}}</h4>
                        @endif
                    </form>
                </div>
            </div>

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
                            <td>{{ucfirst($appointment->start_time->formatLocalized('%a %d/%m/%Y'))}}</td>
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

@endsection